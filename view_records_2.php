<?php
    session_start();
    
    $status="";
    $conn=mysqli_connect('localhost','root','','library users');
    if(!$conn)
    {
        $conn_error="Failed to entablish connetion with database !";
    }
    else
    {
        $temp="";
        if($_SESSION['view']=="Issued")
        {
            $sql="SELECT *  FROM ISSUE WHERE Date_Of_Issue BETWEEN '{$_SESSION['from_date']}' AND '{$_SESSION['to_date']}'";
            $temp="Date_Of_Issue";
        }
        else if($_SESSION['view']=="Previous")
        {
            $sql="SELECT *  FROM ISSUE_RECORDS WHERE Date_Of_Issue BETWEEN '{$_SESSION['from_date']}' AND '{$_SESSION['to_date']}'";
            $temp="Date_Of_Issue";
        }
        else 
        {
            $sql="SELECT *  FROM COLLECT_RECORDS WHERE Return_date BETWEEN '{$_SESSION['from_date']}' AND '{$_SESSION['to_date']}'";  
            $temp="Return_date";
        }
        
        $result=mysqli_query($conn,$sql);
        
        if($result)
        {        
                               
                echo "<h1 style='text-align:center;'>RECORDS</h1>";
                echo "<table border='1' align='center' color=>
                    <tr>
                    <th>Admission year</th>
                    <th>Department</th>
                    <th>Roll</th>
                    <th>Email</th>
                    <th>Book No</th>
                    <th>$temp</th>
                    </tr>";
                while($row=mysqli_fetch_assoc($result))
                {
                        echo "<tr>";
                        echo "<td>" . $row['Adm_yr'] . "</td>";
                        echo "<td>" . $row['Dept'] . "</td>";
                        echo "<td>" . $row['Roll'] . "</td>";
                        echo "<td>" . $row['Email'] . "</td>";
                        echo "<td>" . $row['Book_no'] . "</td>";
                        echo "<td>" . $row["$temp"] . "</td>";
                        echo "</tr>";
                }
                
                echo "</table>";
                mysqli_close($conn);
                
            
            
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
    <!-- <link rel="stylesheet" href="./view_query.css"> -->
    <style>
        body
        {
            background: url("./86280.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
        
        table
        {
            
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
            left: 32%;
            text-decoration: none;
            color: black;
            font-size: 20px;
            
        }
        .a2{
            position: absolute;
            top: 80%;
            left: 32%;
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