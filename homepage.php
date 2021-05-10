<?php
  session_start();
  $splt=preg_split("/@/",$_SESSION['loguser'],2);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="./homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
  </head>
  <body>
    
    
    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>
    
    <div class="sidebar">
        <header><?php echo $splt[0];?></header>
        <ul>
                
                <li><a href="./view_records.php"><i class="fas fa-search"></i>View Records</a></li>
                <li><a href="./About_us.php"><i class="fas fa-beer"></i>About us</a></li>
                <li><a href="./Contact_Us.php"><i class="fas fa-id-badge"></i>Contact Us</a></li>
                <li><a href="./login.php"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li>
                <!-- <li><a href="#"><i class="far fa-question-circle"></i>About</a></li>
                <li><a href="#"><i class="fas fa-sliders-h"></i>Services</a></li>
                <li><a href="#"><i class="far fa-envelope"></i>Contact</a></li> -->
        </ul>
    </div>
    <section >
      
      <div class="content-1">
      <img src="./Charusat logo.png" style="top:8%; left:51%;" width="300px" height="100" alt="image not found !">
      <h1 class="content-2" style="font-size: 50px;">CHARUSAT LIBRARY REGISTER</h1>
      <br>
      <br>
      <h3><i>“  A reader lives a thousand lives before he dies . . . The man who never reads lives only one.”</i></h3>
      <br>
      <br>
      <h2>Welcome to <b>Charusat Library Register</b> !</h2>
      <div class="func">
      <a href="./issue.php">Issue Book</a>
      <a href="./collect.php">Collect Book</a>
      </div>
    </div>
    </section>
  </body>
</html>