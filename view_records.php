<?php
    session_start();
    if(isset($_POST['submit']))
    {
        $_SESSION['from_date']=$_POST['date1'];
        $_SESSION['to_date']=$_POST['date2'];
        $_SESSION['view']=$_POST['view_recd'];
        header("location: view_records_2.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <style>
        #date
        {
            border: none;
            border: 1px solid #000;
            border-radius: 5px;
            background: transparent;
            outline: none;
            height: 40px;
            color: #000;
            font-size: 16px;
        }
        
    </style>
    
    <title>View Records</title>
</head>
<body><div class="loginbox" style="top:44%; left:65%;">
                <h1 style="color:#063146">View Records</h1>
                
                <form action="view_records.php" method="POST">
                   
                    
                    <br>
                    <label for="date" style="font-size:20px;">From</label>
                    <input type="date" name="date1" id="date" required>
                    <br>
                    <label for="date2" style="font-size:20px;">To</label>
                    <input type="date" name="date2" id="date" required>
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['book']);?></div>
                    <br>
                    <p>Which records you want to view ?</p>
                    <br>
                    <label for="Issued">Issued</label>
                    <input type="radio" style="width: 10%; margin-right:40px;" name="view_recd" required value="Issued" id="Issued">
                    <label for="Returned">Returned</label>
                    <input type="radio" style="width: 10%;" name="view_recd" required value="Returned" id="Returned">
                    <br>
                    <label for="Issued">Previous Issued</label>
                    <input type="radio" style="width: 10%; margin-right:40px;" name="view_recd" required value="Previous" id="Issued">
                    
                    <input class="submitform" type="submit" name="submit" value="submit"><br>
                    
                    <a class="flinks" href="./homepage.php">Back to home page.</a><br>
                    
                    
                    <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                    <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
                </form>

            </div>
        </body>
</html>