<?php
    session_start();
    $college=$_SESSION['clg']=$_POST['clg'];
    $dept=$_SESSION['dpt']=$_POST['dpt'];
    $year=$_SESSION['yr']=$_POST['yr'];
    $roll=$_SESSION['id']=$_POST['id'];
    $book_no=$_SESSION['bookno']=$_POST['bookno'];
    $email_not=$_SESSION['emlnot']=$_POST['SendEmailEnquiry'];
    $query_error="";
    $conn_error='';
    $errors=array(['book'=>""]);
    if(isset($_POST['submit']))
    {
        if(!empty($book_no))
        {
            switch($college)
            {
                case 'DEPSTAR': switch($dept)
                                {
                                    case 'CE': $_SESSION['emailid']=$email=$year."dce".$roll."@charusat.edu.in";
                                               break;
                                    case 'CSE': $_SESSION['emailid']=$email=$year."dcs".$roll."@charusat.edu.in";
                                                break;
                                    case 'IT': $_SESSION['emailid']=$email=$year."dit".$roll."@charusat.edu.in";
                                                break;
                                }
                                break;
                case 'CSPIT': switch($dept)
                                {
                                    case 'CE': $_SESSION['emailid']=$email=$year."ce".$roll."@charusat.edu.in";
                                               break;
                                    case 'CSE': $_SESSION['emailid']=$email=$year."cs".$roll."@charusat.edu.in";
                                                break;
                                    case 'IT': $_SESSION['emailid']=$email=$year."it".$roll."@charusat.edu.in";
                                                break;
                                }
                                break;

            }
        }
        else
        {
            $errors['book']="This field cannot be empty !";
        }
        if($errors['book']=="")
        {
            header('Location: view_query.php');
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
    <title>Inquiry Portal</title>
</head>
<body><div class="loginbox" style="top:44%; left:65%;">
                <h1 style="color:#063146">Inquiry Portal</h1>
                <h1 style="color:#063146">(For Students only)</h1>
                <form action="student_inquiry.php" method="POST">
                   
                    
                    
                    <p>Book No.</p>
                    <input type="text" name="bookno" placeholder="Eg: E000001" required>
                    <div style="color: rgb(167, 22, 22);"><?php echo htmlspecialchars($errors['book']);?></div>
                    <label for="clg">College &nbsp;</label>
                    <select name="clg" id="cars" style="width:30%;" required>
                       
                        <option default value="">select</option>
                        <option value="CSPIT">CSPIT</option>
                        <option value="DEPSTAR">DEPSTAR</option>
                        <option value="CMPICA">CMPICA</option>
                        <option value="RCPC">RCPC</option>
                        
                    </select>
                    <br>
                    <br>
                    <label for="dpt"> Branch &nbsp;&nbsp;</label>
                    <select name="dpt"  style="width:30%;" required>
                        
                        <option default value="">select</option>
                        <option value="CE">CE</option>
                        <option value="CSE">CSE</option>
                        <option value="IT">IT</option>
                        <option value="BCA">BCA</option>
                        
                    </select>
                    <br>
                    <br>
                    <label for="yr"> Year &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <select name="yr"  style="width:30%;" required>
                        
                        <option default value="">select</option>    
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        
                    </select>
                    <br>
                    <br>
                    <label for="id">Id&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <select name="id"  style="width:30%;" required>
                             <option default value="">select</option>
                        <?php
                            for ($i=1; $i<=180; $i++)
                            {
                                if($i<=99)
                                {
                                ?>
                                    <option value="<?php echo "0".$i;?>"><?php echo $i;?></option>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php
                                }
                            }
                        ?>
                        
                    </select>
                    <br>
                    <br>
                    <p>Want to receive email about inquiry ?</p>
                    <br>
                    <label for="Yes">Yes</label>
                    <input type="radio" style="width: 30%;" name="SendEmailEnquiry" required value="Yes" id="Yes">
                    <label for="No">No</label>
                    <input type="radio" style="width: 30%;" name="SendEmailEnquiry" required value="No" id="No">

                    <input class="submitform" type="submit" name="submit" value="submit"><br>
                    
                    <a class="flinks" href="./login.php">Back to login page.</a><br>
                    <a class="flinks" href="./student_inquiry.php">Another enquiry ?</a><br>
                    
                    <p style="color:red; margin-top:15px;"> <?php echo htmlspecialchars($conn_error);?></p><br>
                    <p style="color:red; "> <?php echo htmlspecialchars($query_error);?></p><br>
                </form>

            </div>
        </body>
</html>