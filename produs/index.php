<?php 
    if(!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
        header("Location: /produse");
        die();
    }

    $id_produs = (int) $_GET["id"];
?>

<!DOCTYPE html>
<html lang="ro">
    <head>
        <title>CalculatorulTau</title>
        <!-- <meta charset="UTF-8"> -->
        <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
        <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
        <meta name="author" content="Tudor Coman">
        <?php 
            include(getenv('APP_ROOT_PATH') . "/templates/head.php");
            $mysqli = SQLRepository::getInstance()->getConnection();
            $stmt = $mysqli->prepare("SELECT * FROM produse WHERE id = ?");
            $stmt->bind_param("i", $id_produs);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows != 1) {
                header("Location: /produse");
                die();
            }
            $produs = $result->fetch_assoc();
        ?>
        <link href="/assets/css/produs.css" type="text/css" rel="stylesheet" />
        <script>
            id_prod = <?php echo $produs["id"]; ?>;

            function adaugaInCos() {
                var cos = localStorage.getItem("cos_virtual"); // 1, 5, 3
                var q = document.getElementById("quantity").value;
                const mapCos = new Map();
                if(!cos) { 
                    cos = [];
                } else {
                    cos = cos.split(",");
                    for (let prod of cos) {
                        var x = prod.split("|");
                        mapCos.set(x[0], parseInt(x[1]));
                    }
                }
                if (mapCos.get(id_prod))
                    mapCos.set(id_prod, mapCos.get(id_prod) + q);
                else 
                    mapCos.set(id_prod, q);
                var str = "";
                var arr = []; 
                mapCos.forEach((value, key) => arr.push(`${key}|${value}`));
                str = arr.join(",");
                localStorage.setItem("cos_virtual", str);
            }

        </script>
    </head>
    <body>
    <?php 
        require_once getenv('APP_ROOT_PATH') . '/functions/scraping.php';
        require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';
        include(getenv('APP_ROOT_PATH') . "/templates/header.php"); 
    ?>
        
    <main>
        <section>
            <h2>Pagină produs</h2>
                <article id="art-produs">
                    <h3><span class="nume"><?php echo $produs["nume"]; ?></span></h3>
                    <p>Pret: <span class="pret"><?php echo $produs["pret"]; ?>RON </span></p>
                    <p>Descriere: <span class="descriere"><?php echo $produs["descriere"]; ?> </span></p>
                    <p>Materiale: <span class="ingrediente"><?php echo str_replace(array('[', '"', ']'), array("", "", ""), $produs["materiale"]); ?> </span></p>
                    <p>Rating <a href="<?php echo $produs['amazon']; ?>"> Amazon </a>: <?php echo get_amazon_rating($produs["amazon"]); ?> </p>
                    <p>An fabricatie: <span class="an_fabricatie"><?php echo $produs["an_fabricatie"]; ?> </span></p>
                    <p>Greutate: <span class="greutate"><?php echo $produs["greutate"]; ?> g</span></p>
                    <p>Categorie: <span class="categorie"><?php echo $produs["categorie"]; ?> </span></p>
                    <p>Resigilat: <span class="pt_diabetici"><?php echo $produs["resigilat"] ? "DA" : "NU"; ?> </span></p>
                    <p>Stoc: <span class="stoc"><?php echo getStocProdus($produs["id"], 1); ?> bucati </span></p>
                    <p>Data adăugare: <span class="categorie"><?php echo $produs["data_adaugare"]; ?> </span></p>
                    <figure class="imag-produs">
                        <img src="<?php echo $produs['imagine']; ?>" alt="[imagine <?php echo $produs['nume']; ?>]" />
                    </figure>
                    <div class="imag-produs"> <p> Cantitate: <input type="number" min="1" max="<?php echo getStocProdus($produs['id'], 1)?>" value="1" id="quantity">
                    <button onclick="adaugaInCos()"> Adauga in cos </button> </p> </div>
                </article>
            
        </section>
    </main>
    <?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
    </body>
</html>