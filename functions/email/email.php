<?php 
    require_once(getenv('APP_ROOT_PATH') . '/functions/phpmailer/class.phpmailer.php');
    require_once(getenv('APP_ROOT_PATH') . '/functions/phpmailer/mail_config.php');

    function send_email($to, $nume, $subject, $message, $pdf_attachment = null) {
        $mail = new PHPMailer(true); 
        $mail->IsSMTP();

        try {
            $mail->SMTPDebug  = 3;                     
            $mail->SMTPAuth   = true; 

            include(getenv('APP_ROOT_PATH') . '/functions/email/config.php');

            $mail->SMTPSecure = "ssl";                 
            $mail->Host       = $EMAIL_SERVER;      
            $mail->Port       = 465;                   
            $mail->Username   = $EMAIL_USER;  			// GMAIL username
            $mail->Password   = $EMAIL_PASS;            // GMAIL password
            $mail->AddReplyTo($EMAIL_USER, 'CalculatorulTau');
            $mail->AddAddress($to, $nume);
            
            $mail->SetFrom($EMAIL_USER, 'CalculatorulTau');
            $mail->Subject = $subject;
            $mail->AltBody = 'To view this post you need a compatible HTML viewer!'; 
            $mail->MsgHTML($message);
            if (!is_null($pdf_attachment)) {
                $mail->AddStringAttachment($pdf_attachment, 'factura.pdf');
            }
            $mail->Send();
            //echo "Message Sent OK</p>\n";
            } catch (phpmailerException $e) {
            echo $e->errorMessage(); //error from PHPMailer
            } catch (Exception $e) {
            echo $e->getMessage(); //error from anything else!
        }
    }
?>