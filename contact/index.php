<!DOCTYPE html>
<html lang="ro">
	<head>
		<title>Contact</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>
        <link rel="stylesheet" href="/assets/css/formular.css" type="text/css" />
	</head>
	<body class="container">
		<header>
        <?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>
		</header>
		<main>
            <br> <br> 
            <?php if(!empty($statusMsg)){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $status; ?>"><?php echo $statusMsg; ?></div>
            <?php } ?>

            <form action="" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Your name" required pattern="[A-Za-z ]+">

                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Your email" required>

                <label for="message">Message</label>
                <textarea id="message" name="subject" placeholder="Write something.." style="height:200px" required></textarea>

                <div class="g-recaptcha" data-sitekey="6Le5rLUjAAAAAMPxAFTCBK4n7n4TArMi8aIKyNiV"></div> <br>
                <input type="submit" name="submit" value="Submit">
            </form>


            <?php 
                include(getenv('APP_ROOT_PATH') . '/contact/config.php');
                require_once getenv('APP_ROOT_PATH') . '/functions/email/email.php';

                // Google reCAPTCHA API keys settings 
                $secretKey  = $RECAPTCHA_SECRET_KEY; 
                
                // Email settings 
                $recipientEmail = 'suport@daw.coman.io'; 
                
                
                // If the form is submitted 
                $postData = $statusMsg = ''; 
                $status = 'error'; 
                if(isset($_POST['submit'])){ 
                    $postData = $_POST; 
                    
                    // Validate form input fields 
                    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){ 
                        
                        // Validate reCAPTCHA checkbox 
                        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
                
                            // Verify the reCAPTCHA API response 
                            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
                            
                            // Decode JSON data of API response 
                            $responseData = json_decode($verifyResponse); 
                            
                            // Retrieve value from the form input fields 
                            $name = !empty($_POST['name'])?$_POST['name']:''; 
                            $email = !empty($_POST['email'])?$_POST['email']:''; 
                            $message = !empty($_POST['message'])?$_POST['message']:''; 
                            
                            $name_chk = preg_match("/^[a-zA-Z ]+$/", $name);
                            $email_chk = filter_var($email, FILTER_VALIDATE_EMAIL);
                            
                            // If the reCAPTCHA API response is valid 
                            if($responseData->success && $name_chk && $email_chk){ 
                                $message = 'Expeditor: ' . htmlspecialchars($name) . '<br> Adresa de mail: ' . htmlspecialchars($email) . '<br> Mesaj: ' . htmlspecialchars($message);

                                send_email($recipientEmail, "Suport", "Contact form submission", $message);

                                $status = 'success'; 
                                $statusMsg = 'Multumim! Mesajul tau a fost trimis.'; 
                                $postData = ''; 
                            }else{ 
                                $statusMsg = 'Verificarea nu a functionat, te rugam sa incerci din nou.'; 
                            } 
                        }else{ 
                            $statusMsg = 'Te rugam sa bifezi casuta reCAPTCHA.'; 
                        } 
                    }else{ 
                        $statusMsg = 'Te rugam sa completezi toate campurile obligatorii.'; 
                    } 
                } 
            ?>
		</main>
		
		<?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
		
	</body>
</html>