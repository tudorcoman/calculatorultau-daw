<!DOCTYPE html>
<html lang="ro">
<head>
    <title>CalculatorulTau</title>
    <!-- <meta charset="UTF-8"> -->
    <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
    <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
    <meta name="author" content="Tudor Coman">
    <link rel="stylesheet" href="/assets/css/galerie_statica.css">
    <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>  
    <style>
        .responsive {
            width: 100%;
            max-width: 850px;
            height: auto;
        }
    </style>
</head>
<body>
<?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>  
<main class="wrapper">
    <div id="sectiune1">
        <h2><strong>Despre noi</strong></h2>
        <div id="prezentare">
            <p>CalculatorulTau este locul cel mai bun pentru cumparaturile tale de calculator, deoarece avem produse de calitate la preturi competitive. Pe acest site, veti gasi orice componente de calculator, de la A la Z: procesoare (CPU), placi video (GPU), hard disk-uri si solid state drive-uri (HDD/SSD), memorii (RAM), placi de baza, carcase, unitati optice, surse si accesorii de conectica. </p>
        </div>
        <h2><strong>Gama noastra de produse</strong></h2>
        <div id="galerie-statica">
            <?php 
                $imagini = json_decode(file_get_contents('../assets/json/galerie.json'), true); 
                foreach($imagini['imagini'] as $img) {
                    $tok = explode(".", $img['fisier']);
                    $nume_imag = $tok[0]; 
                    $extensie = $tok[1];
                    $dim_mic = 150;
                    $dim_mediu = 300;

                    $mic = $imagini['cale_galerie'] . "/mic/{$nume_imag}-{$dim_mic}.webp";
                    $mediu = $imagini['cale_galerie'] . "/mediu/{$nume_imag}-{$dim_mediu}.webp";
                    $mare = $imagini['cale_galerie'] . "/" . $imagini['fisier']; ?>
                    <figure>
                        <picture>
                            <source srcset="<?php echo $mic; ?>" media="(max-width:800px)" />
                            <source srcset="<?php echo $mediu; ?>" media="(max-width:1200px)" />
                            <img src="<?php echo $mare; ?>" title="<?php echo $img['titlu']; ?>" />
                        </picture>
                        <figcaption><?php echo $img['descriere']; ?> </figcaption>
                    </figure>
            <?php } ?>
        </div>  
    </div>
    <div id="sectiune2">
        <img class="responsive" width="800" src="/assets/img/motherboard.jpg" alt="motherboard">
    </div>
    <div id="sectiune3">
        <h2>Istoric</h2>
        <div id="istoric">
            <p>Povestea noastra incepe inca din anul 2003, cand pe piata romaneasca nu exista o sursa sigura de achizitionare a componentelor de calculator. Viziunea noastra a fost sa creem un magazin, ulterior devenind online, in care sa poata fi gasita orice componenta de PC necesara pentru o varietate de proiecte. </p>
            <p>Incepand din anul 2010, magazinul nostru a inceput vanzarile online, fiind o necesitate pentru aceasta piata. Din 2015, CalculatorulTau este exclusiv online.</p>
        </div>
    </div>
    <div id="sectiune4">
        <h2>Motivatie</h2>
        <div id="motivatie">
            <p>Inca de la inceput, scopul nostru a fost sa oferim produse cu cele mai inalte standarde de calitate,  </p>
            <p>Incepand din anul 2010, magazinul nostru a inceput vanzarile online, fiind o necesitate pentru aceasta piata. Din 2015, CalculatorulTau este exclusiv online.</p>
        </div>
    </div>
    </div>
</main>
<?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>  
</body>
</html>