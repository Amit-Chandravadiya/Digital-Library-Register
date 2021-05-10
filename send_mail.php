<?php
    session_start();
    require 'emailincludes/PHPMailer.php';
    require 'emailincludes/SMTP.php';
    require 'emailincludes/Exception.php';
    
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP; 
    function Send_Notifications($receiver,$sub,$msg,$page)
    {
        $mail= new PHPMailer();
        $mail->isSMTP();
        $mail->Host="smtp.gmail.com";
        $mail->SMTPAuth="true";
        $mail->SMTPSecure='tls';
        $mail->Port="587";
        $mail->Username="charusat.libg8@gmail.com";
        $mail->Password="Amit(G8)";
        $mail->Subject=$sub;
        $mail->setFrom("no-reply@charusatlib.org");
        $mail->isHTML(TRUE);
        $mail->Body=$msg;
        $mail->addAddress("$receiver");
        if($mail->Send())
        {
            switch($page)
            {
                case "login": header("Location: redirect_log.php");
                              break;
                case "regis": header("Location: redirect_reg.php");
                              break;
                case "forgot": header("Location: verify_otp.php");
                               break;
                case "reset": header("Location: redirect_rst.php");
                              break;
                case "Issue": header("Location: redirect_issue.php");
                              break;
                case "Collect": header("Location: redirect_collect.php");
                              break;
                case "Inquiry": 
                                break;
            }
            
            
        }
        else
        {
            echo "error....";
        }
        $mail->smtpClose();
        

    }
?>