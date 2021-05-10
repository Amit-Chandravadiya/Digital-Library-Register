<?php 
    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./redirect.css">
    <script language="javascript" type="text/javascript">window.history.forward();</script>
    <style>
    body{
      background: url("./top-view-books-with-copy-space.jpg") no-repeat;
      background-position:center;
      background-size: 100% 100%;
      height: 100vh;
    }</style>
    <title>Redirecting...</title>
</head>
<body>
    <div class="redirect">
        <h1 style="color:#063146;">Book Collected successfully !</h1>
        <br>
        Redirecting to home page in 
        <br>
        <span id="seconds">3</span> secs
        
    </div>
    <script>
      var seconds = 3;
      setInterval(
        function(){
          if (seconds <= 1) {
            window.location = 'http://localhost/tuts/SGP%20project/homepage.php';
          }
          else {
            document.getElementById('seconds').innerHTML = --seconds;
          }
        },
        900
      );
    </script>
    

</body>
</html>