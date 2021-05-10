<?php
    $errors[]=array(['user'=>'','pass1'=>'','pass2'=>'','phn'=>'']);
    $conn_error='';
    $query_error='';
    $user=$_POST['user'];
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];
    $phno=$_POST['phn'];
    // Importing phpmailer/smtp mail service.
    require "./send_mail.php";  
    // Messages and subject to be sent
    $s="Reg. Registration at Charusat Library Register .";
    $m="<h1>Your Registration done Successfully at Charusat Library Register.<br>You can now take full benifits of your library.</h1>";

    // Checking for submission
    if(isset($_POST['submit']))
    {
        // Checking for user in registration form !
        if(empty($user))
        {
            $errors['user']='User name cannot be empty !';
        }
        else
        {
            if(!filter_var($user,FILTER_VALIDATE_EMAIL))
            {
                $errors['user']=' Please enter valid email !';
            }
             
        }
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
        // Checking for phone number !
        if(empty($phno))
        {
            $errors['phn']="Phone number is required !";
        }
        else
        {
            if(strlen($_POST['phn'])!=10)
            {
                $errors['phn']="Invalid number of digit !";
            }
            
        }
        // Checking if all fields are correct then redirecting to login page using redirect.php !
        if($errors['user']=='' && $errors['phn']==''&& $errors['pass1']=='' && $errors['pass2']=='')
        {
            // Connect to the database !
            $conn=mysqli_connect('localhost','root','','library users');
            // Check connection
            if(!$conn)
            {
                $conn_error="Database Connection error : ".mysqli_connect_error();
            }
            else
            {   
                // using BLOWFISH hashing algorithm for password encryption !
                // why to use BLOWFISH ? :- Because it is more slower than the SHA-256 so, it will be difficult to crack.
                $passhash=password_hash($pass2,PASSWORD_BCRYPT);
                
                // writing query to insert registration details in Database.
                $sql="INSERT INTO user_auth(USER_NAME, PHNO, PASS) VALUES ('$user','$phno','$passhash')";
                $result=mysqli_query($conn,$sql);
                
                if($result)
                {
                    
                    
                    mysqli_close($conn);
                    Send_Notifications($user,$s,$m,"regis");
                    
                }
                else
                {
                    //$conn_error="Database Error : ".mysqli_error();
                      $query_error="User already exist ! Please try other username or phone.";
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
    <style>
        .phno
        {
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color: #fff;
            font-size: 16px;
        }
    </style>
    <title>Register User</title>
</head>
<body>
        <!-- <div class="charusat" style="top:4%; left:46%;"><img src="Charusat-Logo - Copy.jpg" width=100></div> -->
           <div class="loginbox" style="top:49%; left:65%;">
                <h1 style="color: #063146">Register Yourself</h1>
                <p> &ensp;&ensp; Please fill form to create an acccount</p><br>
                <form action="Register.php" method="POST">
                    <p>Username</p>
                    <input type="text" name="user" placeholder="Enter Username" value="<?php echo $user;?>">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['user']);?></div>

                    <p>Phone</p>
                    <input type="text" class="phno" name="phn" id="" placeholder="Enter phone number" value="<?php echo $phno;?>">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['phn']);?></div>

                    <p>Enter Password</p>
                    <input type="password" name="pass1" placeholder="Enter Password" value="<?php echo $pass1;?>">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['pass1']);?></div>

                    <p>Rewrite Password</p>
                    <input type="password" name="pass2" placeholder="Rewrite Password" value="<?php echo $pass2;?>">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['pass2']);?></div>

                    <input class="submitform" type="submit" name="submit" value="Register"><br>
                    <p>Already have an account? <a href="./login.php" style="color: grey; text-decoration: none;">Login</a>.</p>
                </form>
                <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
            </div>
            
        </body>
</html>
