<?php
    $conn_error='';
    $query_error='';
    $user=$_POST['user'];
    $errors[]=array(['user'=>'']);
    // subject and message which will be used in the phpmailer/send_mail.php.

    $s="Reg. password recovery of your account.";
    
     // importing sen_mail.php where phpmailer class is used for smtp mail service  
    require './send_mail.php';    
    
    if(isset($_POST['submit']))
    {   
        // validation of username
        if(empty($user))
        {
            $errors['user']='User name cannot be empty';
        }
        else
        {
            if(!filter_var($user,FILTER_VALIDATE_EMAIL))
            {
                $errors['user']=' Please enter valid email !';
            }
              
        }
        if($errors['user']=='')
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
                
                // Writing sql query
                // checking for the existance of user
                $sql="SELECT USER_NAME FROM user_auth where USER_NAME='$user'";
                $result=mysqli_query($conn,$sql);
                $no=mysqli_num_rows($result);
                    
                if($no)
                {
                    mysqli_close($conn);
                    session_start();
                    $_SESSION['user']=$user;
                    $_SESSION['otp']=substr(str_shuffle("0123456789"),0,5);
                    $m="<h1>Your OTP for password recovery is <h1 style=\" color: yellow \">{$_SESSION['otp']}</h1><h1>Please do not share this with anyone.</h1>";
                    Send_Notifications($user,$s,$m,"forgot");

                }
                else
                {
                    echo $no;
                    $query_error="Invalid username !";
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
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Forgot Password</title>
</head>
<body>
           
           <div class="loginbox" style="top:49%; left:65%;">
                <h1>Forgot Password</h1>
                <p>Please fill form to reset your password</p><br>
                <form action="forgot.php" method="POST">
                    <p>Username</p>
                    <input type="text" name="user" placeholder="Enter Username">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['user']);?></div>

                    <input class="submitform" type="submit" name="submit" value="Submit"><br>
                    <p>Remember password ? <a class="flinks" href="./login.php" style="color: grey; text-decoration: none;">Login</a> .</p>
                </form>
                <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
            </div>
        </body>
</html>