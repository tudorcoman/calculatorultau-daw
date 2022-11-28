<!DOCTYPE html>
<html lang="ro">
	<head>
		<title>Confirmare cont</title>
		<?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>
	</head>
	<body class="container">
		<header>
        <?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>
		</header>
		<main>
			
			<h1>Confirmare mail</h1>
			<!-- <p>Totul a functionat bine!</p> -->
            <?php 
                if(isset($_GET['token']) && isset($_GET['user'])) {
                    $username = $_GET['user'];
                    $token = $_GET['token'];

                    $mysqli = SQLRepository::getInstance()->getConnection();
                    $stmt = $mysqli->prepare("UPDATE utilizatori SET confirmat_mail=true WHERE username=? AND cod=?");
                    $stmt->bind_param("ss", $username, $token);
                    if($stmt->execute())
                        echo "<div class=\"alert alert-success\" role=\"alert\">Totul a functionat bine. Te rugam sa te loghezi. </div>";
                    else 
                        echo "<div class=\"alert alert-danger\" role=\"alert\">A aparut o eroare. Te rugam sa incerci mai tarziu. </div>";

                }
            ?>
		</main>
		
		<?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
		
	</body>
</html>