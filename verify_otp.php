<?php
    session_start();
    $match="";
    $otp=$_POST['otp'];
    $errors[]=array(['otp'=>'']);
      
    
    if(isset($_POST['verify']))
    {   
        // validation of username
        if(empty($otp))
        {
            $errors['otp']='User name cannot be empty';
        }
        else
        {
            if(!preg_match('/^[0-9]*$/',$otp))
            {
                $errors['otp']=' Please enter valid otp !';
            }
              
        }
        if($errors['otp']=='')
        {
            if($_SESSION['otp']!=$otp)
            {
                
                $match="Your OTP doesn't match ! Please re-enter otp.";
            }
            else
            {
                header("Location: reset_pass.php");
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
    <script language="javascript" type="text/javascript">window.history.forward();</script>
    <title>OTP Verification</title>
</head>
<body>
           
           <div class="loginbox" style="top:49%; left:65%;">
                <h1>OTP Verification</h1>
                <p>Please verifiy OTP to reset your password</p>
                <p>OTP hasbeen sent to your registered email/username</p><br>
                <form action="verify_otp.php" method="POST">
                    <br>
                    <p>OTP</p>
                    <input type="text" name="otp" placeholder="Enter OTP">
                    
                    <input class="submitform" type="submit" name="verify" value="Verify"><br>
                    <p>Remember password ? <a class="flinks" href="./login.php" style="color: grey; text-decoration: none;">Login</a> .</p>
                </form>
                <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($match);?></p><br>
                
            </div>
        </body>
</html>