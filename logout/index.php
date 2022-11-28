<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
        <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
        <link rel="stylesheet" href="/assets/css/produse.css" type="text/css" />
        <title>CalculatorulTau</title>
        <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?> 
        <script type="text/javascript" src=/assets/js/produse.js></script>
    </head>
    <body>
        <?php 
            session_unset();
            session_destroy();
            include(getenv('APP_ROOT_PATH') . "/templates/header.php");
        ?>

    <main>
    Ai fost delogat!
</main>

<?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>

</body>
</html>