<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta name="keywords" content="componente calculator, componente PC, procesoare, inregistrare, utilizatori, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
        <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
        <meta name="author" content="Tudor Coman">
        <link rel="stylesheet" href="/assets/css/produse.css" type="text/css" />
        <title>CalculatorulTau</title>
        <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php") ?>     
        <script type="text/javascript" src=/assets/js/inregistrare.js></script>
    </head>
    <body>
        <?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>
        <main>
            <div class="afisaj">
                <h1>Inregistrare utilizator</h1>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == "POST") { 
                        require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';
                        require_once getenv('APP_ROOT_PATH') . '/functions/email/email.php';

                        function get_field($key) {
                            return isset($_POST[$key]) ? $_POST[$key] : "";
                        }

                        function generate_token($username) {
                            $sirAT = "ABCDEFGHIJKLMNOPQRST";
                            $sirCifre = "0123456789";

                            $token1 = "";
                            $token2 = $username . '-';
                            for($i = 0; $i < 10; $i ++)
                                $token1 .= $sirCifre[rand(0, 9)];
                            for($i = 0; $i < 70; $i ++)
                                $token2 .= $sirAT[rand(0, 19)];
                            return $token1 . $token2; 
                        }

                        $eroare = "";
                        $username = get_field("username");
                        $email = get_field("email");
                        $parola = get_field("parola");
                        $rparola = get_field("rparola");
                        $nume = get_field("nume");
                        $prenume = get_field("prenume");

                        if($username == "")
                            $eroare .= "Username necompletat. ";
                        if(!preg_match("/^[A-Za-z0-9]+$/", $username))
                            $eroare .= "Username nu contine caracterele cerute. ";
                        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                            $eroare .= "Emailul nu este valid. ";

                        if(preg_match("/^.*[%\\^&\\*].*$/", $parola) || preg_match("/^.*[%\\^&\\*].*$/", $rparola))
                            $eroare .= "Parola contine caractere interzise. ";

                        if($parola != $rparola)
                            $eroare .= "Parolele sunt diferite. ";

                        if($eroare == "") {
                            if(getUsernameResults($username)->num_rows == 0) {
                                $token = generate_token($username);
                                $parolaCriptata = password_hash($parola, PASSWORD_DEFAULT);
                                $mysqli = SQLRepository::getInstance()->getConnection();
                                $stmt = $mysqli->prepare("INSERT INTO utilizatori (username, nume, prenume, parola, email, cod) VALUES (?, ?, ?, ?, ?, ?)");
                                
                                if ($stmt === FALSE) {
                                    $eroare.= $mysqli->error;
                                } else {
                                    $stmt->bind_param("ssssss", $username, $nume, $prenume, $parolaCriptata, $email, $token);
                                    if(!$stmt->execute())
                                        $eroare .= "Eroare baza de date. ";
                                    else {
                                        $url = "";
                                        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                                            $url = "https://";   
                                        else  
                                            $url = "http://";   
                                        // Append the host(domain name, ip) to the URL.   
                                        $url.= $_SERVER['HTTP_HOST'];   
                                        $linkConfirmare = "$url/confirmare?user=$username&token=$token";
                                        send_email($email, "$prenume $nume", "Buna, $username!", "<h1 style='background-color: lightblue;'>Bine ai venit in comunitatea CalculatorulTau!</h1><p>Username-ul tau este $username.</p><p>Link confirmare: <a href=\"$linkConfirmare\">$linkConfirmare</a></p>");
                                    }
                                }
                                
                            } else {
                                $eroare .= "Username-ul mai exista. ";
                            }
                        }

                        if ($eroare != "")
                            echo "<div class=\"alert alert-danger\" role=\"alert\">$eroare</div>";
                        else 
                            echo "<div class=\"alert alert-success\" role=\"alert\">Ati fost inregisrat cu succes. Va rugam sa va confirmati adresa de mail. </div>";
                    }
                ?>

                <form id="form_inreg"  method="post" class="date"  action="/inregistrare/index.php"  enctype="multipart/form-data">
                    <p>
                        <label>
                            Username: <input type="text" name="username" id="inp-username" required pattern="[A-Za-z0-9]+">
                        </label>
                    </p>
                    <p>
                        <label>
                            Nume: <input type="text" name="nume" id="inp-nume">
                        </label>
                    </p>
                    <p>
                        <label>
                            Prenume: <input type="text" name="prenume" id="inp-prenume">
                        </label>
                    </p>
                    <p>
                        <label>
                            Parola: <input id="parl" type="password" required  name="parola" value="">
                        </label>
                    </p>
                    <p id="p-reintrod">
                        <label >
                            Reintroduceti parola: <input id="rparl" required type="password" name="rparola" value="">
                        </label>
                    </p>

                    <p>
                        <label>
                            Email: <input type="text" name="email" id="inp-email" required size="50">
                        </label>
                    </p>
                    <p>		
                        <input type="submit" value="Trimite">
                        <input type="reset" value="Reseteaza">
                    </p>
                </form>
            </div>
        </main>

    <?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
    </body>
</html>