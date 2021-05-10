<?php
    session_start();
    $conn_error='';
    $query_error='';
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];
    $errors[]=array(['pass1'=>'','pass2'=>'']);
    // subject and message which will be used in the phpmailer/send_mail.php.

    $s="Reg. password recovery of your account.";
    
     // importing sen_mail.php where phpmailer class is used for smtp mail service  
    require './send_mail.php';    
    
    if(isset($_POST['reset']))
    {   
        
        // Checking for password !
        if(empty($pass1))
        {
            $errors['pass1']="password cannot be empty !";
        }
        else
        {   
            // Checking for rewrite password !
            if(empty($pass2))
            {
                $errors['pass2']="password cannot be empty !";
            }
            else
            {
                if($pass1!=$pass2)
                {
                    $errors['pass2']="your password doesn't match !";
                }
                
            }
        }
        if($errors['pass1']=='' && $errors['pass2']=='')
        {
            // connecting to dbms server !
            $conn=mysqli_connect('localhost','root','','library users');
                
            // checking for connection enstablishment
            if(!$conn)
            {
                $conn_error="Database Connection Error:".mysqli_connect_error();
            }
            else
            {
                
                // using BLOWFISH hashing algorithm for password encryption !
                // why to use BLOWFISH ? :- Because it is more slower than the SHA-256 so, it will be difficult to crack.
                $passhash=password_hash($pass2,PASSWORD_BCRYPT);
                // Writing sql query
                // checking for the existance of user
                $sql="UPDATE user_auth SET PASS='$passhash' WHERE USER_NAME='{$_SESSION['user']}'";
                $result=mysqli_query($conn,$sql);
                echo $result;
                    
                if($result)
                {
                    
                    $m="<h1>Your password hasbeen sucessfully reset.<br>Do not share it with anyone.</h1>";
                    Send_Notifications($_SESSION['user'],$s,$m,"reset");

                }
                else
                {
                    
                    $query_error="Failed to reset your password !";
                }
            }
        }
    }

    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script language="javascript" type="text/javascript">window.history.forward();</script>
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Reset Password</title>
</head>
<body>
           
           <div class="loginbox" style="top:49%; left:65%;">
                <h1>Reset Password</h1>
                
                <form action="reset_pass.php" method="POST">
                    <br>
                    <p>Enter New Password</p>
                    <input type="password" name="pass1" placeholder="Enter Password">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['pass1']);?></div>
                    
                    <p>Confirm Password</p>
                    <input type="password" name="pass2" placeholder="Re-enter Password">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['pass2']);?></div>

                    <input class="submitform" type="submit" name="reset" value="Reset"><br>
                    <p>Remember password ? <a class="flinks" href="./login.php" style="color: grey; text-decoration: none;">Login</a> .</p>
                </form>
                <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
            </div>
        </body>
</html>