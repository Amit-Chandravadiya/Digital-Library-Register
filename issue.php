<?php
/*
*   THIS PHP FILE IS USED FOR SCANNING STUDENT'S LIBRARY CARD THROUGH  WEBCAM.
*
*
*/
session_start();
  $errors=array(['QRvalue'=>""]);
  if(isset($_POST['submit']))
  {
    if(empty($_POST['QRvalue']))
    {
        $errors['QRvalue']="This cannot be empty !";
    }
    else
    {
      $splited=preg_split("/-/",$_POST['QRvalue'],4);
      if(!preg_match_all("/[a-zA-Z]/",$splited[0]))
      {
        //echo $splited[0];
        if(!preg_match_all("/[0-9]/",$splited[1]))
        {
          if(!preg_match_all("/[a-zA-Z]/",$splited[2]))
          {
            if(!filter_var($splited[3],FILTER_VALIDATE_EMAIL))
            {
              $errors['QRvalue']='Invalid QR code value !';
            }
            
          }
          else
          {
            $errors['QRvalue']="Invalid QR code value !";
          }
        }
        else
        {
          $errors['QRvalue']="Invalid QR code value !";
        }

      }
      else
      {
        $errors['QRvalue']="Invalid QR code value !";
      }
      
    }
    if($errors['QRvalue']=="")
    {
      $_SESSION['QRvalue']=$splited;
      header("location: issue2.php");
      // echo $_SESSION['QRvalue'][0];
      // echo $_SESSION['QRvalue'][1];
      // echo $_SESSION['QRvalue'][2];
      // echo $_SESSION['QRvalue'][3];
    }

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>window.history.forward();</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  
    <link rel="stylesheet" href="./issue.css">
    <title>Issue Book</title>
</head>
<body>
<div class="loginbox" style="top:35%; left:65%;">
                <h1 style="color: #063146; text-align:center; font-size:35px;">STUDENT DETAILS</h1>
                <p style="text-align: center; font-size:20px;">Please submit student's details</p>

                <form action="issue.php" method="POST">

                    <p style="text-align: center; font-size:20px;">Scan QR Code</p>
                    <br>
                    <video id="preview" style="width: 309px;"></video>
                    <input type="text" name="QRvalue" id="scanned" placeholder="Scanned QR code value" value="">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['QRvalue']);?></div>

                    <input class="submitform" type="submit" name="submit" value="Submit"><br>
                    <p>go to homepage <a href="./homepage.php" style="color: grey; text-decoration: none;">Home</a>.</p>

                </form>
                
            </div>
    
    <script type="text/javascript" src="QR.js">
    </script>
</body>
</html>