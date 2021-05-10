<?php
    session_start();
    $errors[]=array(['user'=>'','pass'=>'']);
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    $conn_error='';
    $query_error='';
    $_SESSION['loguser']=$user;
    // subject and message which will be used in the phpmailer/send_mail.php.

    $s="Reg. Login at Charusat Library Register.";
    $m="<h1>Login activity detected in your account at Charusat Library Register. If it was you then please ignore this mail else contact Higher Authority.</h1>";
    
    // importing sen_mail.php where phpmailer class is used for smtp mail service  
    require './send_mail.php';
    
    if(isset($_POST['submit']))
    {   
        // validation of login form
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
        if(empty($pass))
        {
            $errors['pass']="password cannot be empty !";
        }
        if($errors['user']=='' && $errors['pass']=='')
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
                $sql="SELECT USER_NAME,PASS FROM user_auth where USER_NAME='$user'";
                $result=mysqli_query($conn,$sql);
                $no=mysqli_num_rows($result);
                $value=mysqli_fetch_assoc($result);
                
                if($no)
                {
                    // verifying corresponding password 
                    if(password_verify($pass,$value["PASS"]))
                    {
                        mysqli_close($conn);
                        Send_Notifications($user,$s,$m,"login");
                        
                    }
                    else
                    {
                        $query_error="Invalid username or password !";
                    }
                    
                }
                else
                {
                    
                    $query_error="Invalid username or password !";
                }
                

            }

        }
    }
    else
    {

    }
    
    //-----------------------------------PHP ends here----------------------------------------------------//
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script language="javascript" type="text/javascript">window.history.forward();</script>
    <title>Book Issuer</title>
</head>
<body>
           <!-- <div class="charusat" style="top:4%; left:46%;"><img src="Charusat-Logo - Copy.jpg" width=100></div> -->
           <div class="loginbox" style="top:49%; left:65%;">
                <h1 style="color:#063146">Charusat Library Register</h1>
                <h1 style="color:#063146">Login Here</h1>
                <form action="login.php" method="POST">
                   
                    <p>Username</p>
                    <input type="text" name="user" placeholder="Enter email as user name">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['user']);?></div>
                    
                    <p>Password</p>
                    <input type="password" name="pass" placeholder="Enter Password">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['pass']);?></div>
                    
                    <input class="submitform" type="submit" name="submit" value="submit"><br>
                    
                    <a class="flinks" href="./forgot.php">Forget Password ?</a><br>
                    <a class="flinks" href="./register.php">Don't have an account ?</a><br>
                    <a class="flinks" href="./student_inquiry.php">Book inquiry ?</a><br>
                    
                    <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                    <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
                </form>

            </div>
        </body>
</html>
