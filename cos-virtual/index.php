<!DOCTYPE html>
<html  lang="ro">
    <head>
        <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
        <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
        <link rel="stylesheet" href="/assets/css/cos-virtual.css" type="text/css" />
        <title>CalculatorulTau - cos virtual</title>
        <!-- <link rel="stylesheet" href="/assets/css/produse.css" type="text/css" /> -->
        <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>  
        <script type="text/javascript" src="/assets/js/cos_virtual.js"></script>
        <link rel="stylesheet" href="/assets/css/formular.css" type="text/css" />
        <style>
            #livrare {
                width: 50%; 
            }
            #facturare {
                width: 50%; 
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
        </style>
    </head>
    <body>
    <?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>

    <main>
        <h1>Cosul tau virtual</h1>
        <div id="continut-pagina">
            <section id="sectiune-cos">
            </section>

            <br>

            <button id="curata" class="buton-verde" onclick="curataCos()">
                Goleste cosul
            </button> 

            <?php if(isset($_SESSION["user_id"])): ?>
                <section>
                    <h2>Detalii despre comanda </h2>
                    <form action="/produse/order.php" onsubmit="curataCos()" id="sendOrderForm" method="post">
                        <label> Adresa de livrare: <input type="text" id="livrare" name="livrare" required pattern="[A-Za-z0-9 ,.]+$"></label> <br>
                        <label> Adresa de facturare: <input type="text" id="facturare" name="facturare" required pattern="[A-Za-z0-9 ,.]+$"></label> <br>
                        <input type="hidden" id="cos" name="cos">
                        <input type="submit" class="buton-verde" name="submit" value="Trimite comanda">
                    </form>
                </section>
            <?php else: ?>
                Trebuie sa fii conectat pentru a putea finaliza comanda!
            <?php endif; ?>
        </div>
    </main>

    <?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
    </body>
</html>