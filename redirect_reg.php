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
    <title>Redirecting...</title>
</head>
<body>
    <div class="redirect">
        <h1 style="color:#063146;">Registration successful !</h1>
        <br>
        Redirecting to login page in 
        <br>
        <span id="seconds">3</span> secs
        
    </div>
    <script>
      var seconds = 3;
      setInterval(
        function(){
          if (seconds <= 1) {
            window.location = 'http://localhost/tuts/SGP%20project/login.php';
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