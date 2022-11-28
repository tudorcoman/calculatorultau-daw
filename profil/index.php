<?php 
    if(!isset($_SESSION["user_id"])) {
        header("Location: /");
        die();
    }

    require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';
    $user = getUserInfo($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="ro">
	<head>
		<title>Profil</title>
		<?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>
        
		<link rel="stylesheet" type="text/css" href="/assets/css/contact.css" />
	</head>
	<body class="container">
		<?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>
		<main>
		
			<section>
				<h2>Profil</h2>
				<!-- <p><%= locals.mesaj %></p> -->
			</section>
			<form id="form_inreg"  method="post" class="date"  action="/profil"  enctype="multipart/form-data">
                <p>
                    <label>
                        Username: <input type="text" name="username" id="inp-username" value="<?php echo $user["username"]; ?>" readonly pattern="[A-Za-z0-9]+">
                    </label>
                </p>
                <p>
                    <label>
                        Nume: <input type="text" name="nume" id="inp-nume"  value="<?php echo $user["nume"]; ?>" >
                    </label>
                </p>
                <p>
                    <label>
                        Prenume: <input type="text" name="prenume" id="inp-prenume" value="<?php echo $user["prenume"]; ?>"  >
                    </label>
                </p>
                <p>
                    <label>
                        Parola: <input id="parl" type="password" required  name="parola" value="">
                    </label>
                </p>

                <p id="parola-noua-1" style="display: none;">
                    <label>
                        Parola noua: <input id="parl" type="password"  name="parolanoua" value="">
                    </label>
                </p>

                <p id="parola-noua-2" style="display: none;">
                    <label>
                        Confirmati parola noua: <input id="parl" type="password"  name="rparolanoua" value="">
                    </label>
                </p>

                <p>
                    <label>
                        Email: <input type="text" name="email" id="inp-email" required value="<?php echo $user["email"]; ?>" size="50">
                    </label>
                </p>
                <p>
                    <label>
                        Poza: <input type="file" name="poza">
                    </label>			
                </p>
                <p>		
                    <input type="submit" value="Trimite">
                    <input type="reset" value="Reseteaza">
                </p>
            </form>
		</main>
		
		<?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php") ?>
		
	</body>
</html>

