<?php
/*
*   THIS PHP FILE IS USED FOR SCANNING BOOK'S DETAILS THROUGH  WEBCAM.
*
*
*/
    session_start();
    $errors=array(['QRvalue'=>""]);
    $conn_error='';
    $query_error='';
    // importing send_mail.php for sending notification to the student !
    require "./send_mail.php";
    // validating QRvalue !
    if(isset($_POST['submit']))
    {
        if(empty($_POST['QRvalue']))
        {
            $errors['QRvalue']="This cannot be empty !";
        }
        if($errors['QRvalue']=="")
        {
            $book_qr=$_POST['QRvalue'];
            $conn=mysqli_connect('localhost','root','','library users');
            if(!$conn)
            {
                $conn_error="Database Connection Error:".mysqli_connect_error();
            }
            else
            {
                $sql="INSERT INTO ISSUE (Adm_yr,Dept,Roll,Email,Book_no) VALUES ('{$_SESSION['QRvalue'][0]}','{$_SESSION['QRvalue'][1]}','{$_SESSION['QRvalue'][2]}','{$_SESSION['QRvalue'][3]}','$book_qr')";
                $sql1="SELECT count(Email) AS Num FROM ISSUE WHERE  Email='{$_SESSION['QRvalue'][3]}'";
                $sql2="INSERT INTO ISSUE_RECORDS (Adm_yr,Dept,Roll,Email,Book_no) VALUES ('{$_SESSION['QRvalue'][0]}','{$_SESSION['QRvalue'][1]}','{$_SESSION['QRvalue'][2]}','{$_SESSION['QRvalue'][3]}','$book_qr')";
                $sql3="SELECT count(Email) AS Num FROM ISSUE WHERE  Book_no='{$book_qr}'";
                $result=mysqli_query($conn,$sql1);
                $res=mysqli_fetch_assoc($result);
                
                if($res['Num']<4) // Checking if the student already issued 4 books or not ! if issued he cannot issue more !
                {   
                    $result=mysqli_query($conn,$sql3);
                    $res=mysqli_fetch_assoc($result);
                    if($res['Num']==0)
                    {
                        $result=mysqli_query($conn,$sql);
                        if($result)
                        {
                            $result=mysqli_query($conn,$sql2);
                            if(!$result)
                            {
                                $query_error="1 Failed to do entry into database !";
                            }
                            else
                            {
                                $result=mysqli_query($conn,"SELECT * FROM BOOKS WHERE Book_no='$book_qr'");
                                $res=mysqli_fetch_assoc($result);
                                $ReturnDate=Date('d/m/y', strtotime('+21 days'));
                                $m="<h2>Thank You for Issuing book !</h2><br><h3>Following are the details of the book that you issued.</h3><br><table style='border: 1px solid black; border-style: collapse;'><tr style='border: 1px solid black; padding: 10px; text-align:center;'><th>Book No</th><th>Title</th><th>Author</th><th>Purchase Date</th></tr><tr style='border: 1px solid black; padding: 10px; text-align:center;'><td style='border: 1px solid black; padding: 10px;'>".$res['Book_no']."</td><td style='border: 1px solid black; padding: 10px;'>".$res['Book_title']."</td><td style='border: 1px solid black; padding: 10px;'>".$res['Author']."</td><td style='border: 1px solid black; padding: 10px;'>".$res['Purchase_date']."</td></tr> </table><br><br>"."Returning date of your book is on or before :</h3><h3 style='color:yellow;'>".$ReturnDate."</h3>";
                                
    
                                $s="Reg. Book Issuing at Charusat Library ";
                                mysqli_close($conn);
                                Send_Notifications($_SESSION['QRvalue'][3],$s,$m,"Issue");
                                // echo $res['Book_no'];
                                // echo $res['Book_title'];
                                // echo $res['Author'];
                                // echo $res['Purchase_date'];


                            
                            }
                        }
                        else
                        {
                            $query_error="2 Failed to do entry into database !";
                        }
                    }
                    else
                    {
                        $query_error="This book has already been issued !";
                    }
                }
                else
                {
                    $query_error="You have already issued 4 Books you cannot issue more until you return it back !";
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
    <script>window.history.forward();</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  
    <link rel="stylesheet" href="./issue.css">
    <title>Issue Book</title>
</head>
<body>
<div class="loginbox" style="top:35%; left:65%;">
                <h1 style="color: #063146; text-align:center; font-size:35px;">BOOK DETAILS</h1>
                <p style="text-align: center; font-size:20px;">Please submit details about book</p><br>

                <form action="issue2.php" method="POST">

                    <p style="text-align: center; font-size:20px;">Scan QR Code</p>
                    <br>
                    <video id="preview" style="width: 309px;"></video>
                    <input type="text" name="QRvalue" id="scanned" placeholder="Scannde QR code value" value="">
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['QRvalue']);?></div>

                    <input class="submitform" type="submit" name="submit" value="Submit"><br>
                    <p>go to homepage <a href="./homepage.php" style="color: grey; text-decoration: none;">Home</a>.</p>

                </form>
                <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
                
            </div>
    
    <script type="text/javascript" src="QR.js">
    </script>
</body>
</html>