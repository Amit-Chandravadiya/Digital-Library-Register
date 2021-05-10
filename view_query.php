<?php
    session_start();
    // importing php mailer
    require "send_mail.php";
    $s="Reg. Book Inquiry at Charusat Library ";
    $status="";
    $conn=mysqli_connect('localhost','root','','library users');
    if(!$conn)
    {
        $conn_error="Failed to entablish connetion with database !";
    }
    else
    {
        $sql="SELECT Date_Of_Issue,count(Email) as num FROM ISSUE WHERE Book_no='{$_SESSION['bookno']}'";
        $result=mysqli_query($conn,$sql);
        $no=mysqli_fetch_assoc($result);
        if($result)
        {
            $date=date('d/m/y',strtotime($no['Date_Of_Issue'].'+21 days'));
            if($no['num']!=0)
            {   
                $status="<td style='color: red;'> Not Available </td>";
                $result=mysqli_query($conn,"SELECT * FROM BOOKS WHERE Book_no='{$_SESSION['bookno']}'");
                $row=mysqli_fetch_assoc($result);
                echo "<h1 style='position:absolute; top:21%; left:38%;'>Thank you for your inquiry regarding book.</h1>";
                echo "<table border='1' color=>
                    <tr>
                    <th>Book No</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Purchase Date</th>
                    <th>Status</th>
                    </tr>";
                echo "<tr>";
                echo "<td>" . $row['Book_no'] . "</td>";
                echo "<td>" . $row['Book_title'] . "</td>";
                echo "<td>" . $row['Author'] . "</td>";
                echo "<td>" . $row['Purchase_date'] . "</td>";
                echo $status;
                echo "</tr>";
                echo "</table>";
                echo "<div><h2>This book is not available right now.<br>It is already issued and It will be returned on or after {$date}.</h2></div>";
                echo "<br><br><br><a class='a1' href='./student_inquiry.php'>Another Inquiry ?</a>";
                echo "<br><a href='./login.php' class='a2'>Exit.</a>";
                $m="<h2>Thank You for your inquiry regarding book !</h2><br><h3>Following are the details of the book that you inquired.</h3><br><table style='border: 1px solid black; border-style: collapse;'><tr style='border: 1px solid black; padding: 10px; text-align:center;'><th>Book No</th><th>Title</th><th>Author</th><th>Purchase Date</th></tr><tr style='border: 1px solid black; padding: 10px; text-align:center;'><td style='border: 1px solid black; padding: 10px;'>".$row['Book_no']."</td><td style='border: 1px solid black; padding: 10px;'>".$row['Book_title']."</td><td style='border: 1px solid black; padding: 10px;'>".$row['Author']."</td><td style='border: 1px solid black; padding: 10px;'>".$row['Purchase_date']."</td></tr> </table><br><br>Status of Book : "."<p style='color:red;'>Not Available<p>"."<br><br>It is already issued and It will be returned on or after : <p style='color: red;'>$date</p>";
                mysqli_close($conn);
                
            }
            else
            {
                $status="<td style='color: green;'>Available </td>";
                $result=mysqli_query($conn,"SELECT * FROM BOOKS WHERE Book_no='{$_SESSION['bookno']}'");
                $row=mysqli_fetch_assoc($result);
                echo "<h1 style='position:absolute; top:21%; left:38%;'>Thank you for your inquiry regarding book.</h1>";
                echo "<table border='1' color=>
                    <tr>
                    <th>Book No</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Purchase Date</th>
                    <th>Status</th>
                    </tr>";
                echo "<tr>";
                echo "<td>" . $row['Book_no'] . "</td>";
                echo "<td>" . $row['Book_title'] . "</td>";
                echo "<td>" . $row['Author'] . "</td>";
                echo "<td>" . $row['Purchase_date'] . "</td>";
                echo $status;
                echo "</tr>";
                echo "</table>";
                echo "<div style='color: green;'><h2>This book is available right now.<br>You can visit library during college hours and collect it.<br><br>**INSTRUCTIONS**<br><br>1) Students are allowed to keep books only for 21 days.<br>2) Only 4 books can be issued per student.</h2></div>";
                echo "<br><br><br><a class='a1' href='./student_inquiry.php'>Another Inquiry ?</a>";
                echo "<br><a href='./login.php' class='a2'>Exit.</a>";
                $m="<h2>Thank You for your inquiry regarding book !</h2><br><h3>Following are the details of the book that you inquired.</h3><br><table style='border: 1px solid black; border-style: collapse;'><tr style='border: 1px solid black; padding: 10px; text-align:center;'><th>Book No</th><th>Title</th><th>Author</th><th>Purchase Date</th></tr><tr style='border: 1px solid black; padding: 10px; text-align:center;'><td style='border: 1px solid black; padding: 10px;'>".$row['Book_no']."</td><td style='border: 1px solid black; padding: 10px;'>".$row['Book_title']."</td><td style='border: 1px solid black; padding: 10px;'>".$row['Author']."</td><td style='border: 1px solid black; padding: 10px;'>".$row['Purchase_date']."</td></tr> </table><br><br>Status of Book : "."<p style='color:green;'>Available<p>"."<br><br>It is available and you can come and collect it from library during college hours.";
    
                mysqli_close($conn);
                
                
            }
            if($_SESSION['emlnot']=='Yes')
            {
                Send_Notifications($_SESSION['emailid'],$s,$m,"Inquiry");
            }
            
        }
        else
        {
            $query_error="Failed to perform entry in database !";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view_query.css">
    <style>
        div{
            color: red;
            position: absolute;
            top: 45%;
            left: 38%;
        }
        table
        {
            position: absolute;
            top: 29%;
            left: 38%;
            font-size: 25px;
        }
        table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 10px;
               
        }
        .a1{
            position: absolute;
            top: 77%;
            left: 38%;
            text-decoration: none;
            color: black;
            font-size: 20px;
            
        }
        .a2{
            position: absolute;
            top: 80%;
            left: 38%;
            text-decoration: none;
            color: black;
            font-size: 20px;
            
        }
        a:hover
        {   
            
            text-decoration: underline;
        }

    </style>
    <title>Document</title>
</head>
<body>
    
</body>
</html>