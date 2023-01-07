<!DOCTYPE html>
<html lang="ro">
    <head>
        <title>CalculatorulTau</title>
        <!-- <meta charset="UTF-8"> -->
        <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
        <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
        <meta name="author" content="Tudor Coman">
        <link rel="stylesheet" href="/assets/css/produse.css" type="text/css" />
        <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php");

            $mysqli = SQLRepository::getInstance()->getConnection();
            
            if(!isset($_GET["categorie"])) {
                $result = $mysqli->query("SELECT * FROM produse");
            } else {
                $stmt = $mysqli->prepare("SELECT * FROM produse WHERE categorie = ?");
                $stmt->bind_param("s", $_GET["categorie"]);
                $stmt->execute();
                $result = $stmt->get_result();
            }

            $produse = [];
            $ani = [];
            $culori = [];
            $materiale = [];
            $tipuri = [];
            while($produs = $result->fetch_assoc()) {
                $produse[] = $produs;
                $ani[] = $produs["an_fabricatie"];
                $culori[] = $produs["culoare"];
                $tipuri[] = $produs["tip_produs"];
                $materiale = array_merge($materiale, json_decode($produs["materiale"]));
            }

            $ani = array_unique($ani);
            $culori = array_unique($culori);
            $materiale = array_unique($materiale);
            $tipuri = array_unique($tipuri);

        ?>     
        <script type="text/javascript" src=/assets/js/produse.js></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>

    <main>
        <br />
        <label> Nume: <input type="text" id="inp-nume"></label>
        
        <br />
        <label>An fabricatie:</label>
        <input list="ani" name="an" id="inp-an">
        <datalist id="ani">
            <?php 
                foreach($ani as $an)
                    echo "<option value=\"$an\">"; 
            ?>
        </datalist>

        <div> Greutate:
            <p><label>Foarte usor (greutate &lt; 150)
                <input id="i_rad1"  name="gr_rad" value="0:150" type="radio"/>
            </label></p>
            <p><label>Mediu (150 &le; greutate &lt; 500)
                <input id="i_rad2"  name="gr_rad" value="150:500" type="radio"/>
            </label>
            <p><label>Greu (500 &le; greutate)
                <input id="i_rad3" name="gr_rad" value="500:1000000000" type="radio"/>
            </label>
            <p><label>Toate
                <input id="i_rad4" checked name="gr_rad" value="toate" type="radio"/>
            </label>
        </div>

        <label>Descriere: </label> <textarea id="inp-descriere" name="desc" rows="4" cols="50"></textarea> 
        <br /> <br />

        <label>Culoare:</label>
        <select name="culoare" id="inp_culoare" multiple>
            <?php 
                foreach($culori as $culoare) {
                    $text_culoare = ucfirst($culoare);
                    echo "<option value=\"$culoare\">$text_culoare</option>";
                }
            ?>
        </select>

        <br /> <br />
        <div id="filtru-materiale"> Materiale:
            <?php 
                foreach($materiale as $material) { ?>
                    <p><label> <?php echo $material; ?>
                    <input type="checkbox" id="inp-<?php echo $material; ?>" />
                    <input id="i_rad1_<?php echo $material; ?>"  name="gr_rad_<?php echo $material; ?>" value="are" type="radio" checked/> <label> are </label>
                    <input id="i_rad2_<?php echo $material; ?>"  name="gr_rad_<?php echo $material; ?>" value="nu are" type="radio"/> <label> nu are </label>
                    </label></p>
            <?php } ?>
        </div> 
        <label> Pret minim: 0 <input type="range" id="inp-pret" value="0" min="0"  max="1000"> 1000 <span id="infoRange">(0)</span></label>
        <label>Tip produs:
            <select id="inp-tip">
                <option id="sel-toate" selected value="toate">toate</option>
                <?php foreach($tipuri as $tip) { ?>
                    <option value="<?php echo $tip; ?>"><?php echo $tip; ?></option>
                <?php } ?>
            </select>
        </label>
        <p>
        <button id="filtrare">Filtreaza</button> <button id="resetare">Reseteaza</button><br/>
        <button id="sortCrescNume">Sorteaza crescator</button>
        <button id="sortDescrescNume">Sorteaza descrescator</button>
        <button id="calculSuma">Calculeaza suma preturilor produselor afisate </button>

        </p>
        
        <section id="produse">
            <h2>Produse</h2>
            <div class="grid-produse">
                <?php foreach($produse as $produs) { ?>
                    <article class="produs" id="artc-<?php echo $produs["id"]; ?>">
                        <h3 class="nume"><a href="/produs?id=<?php echo $produs["id"]; ?>" ><span class="val-nume"><?php echo $produs["nume"]; ?></span></a></h3>
                        <div class="grid-interior-produs">
                            <div class="rand">
                                <div class="item-stanga">
                                    <figure>
                                        <a href="/produs?id=<?php echo $produs["id"]; ?>" ><img src="<?php echo $produs["imagine"]; ?>" style="width:50%;height:auto;" alt="[imagine <?php echo $produs["nume"]; ?>]" /></a>
                                    </figure>

                                    <ul>
                                        <li><a class="nume-caracteristica">Pret: </a> <span class="val-pret"><?php echo $produs["pret"]; ?></span> RON</li>
                                        <li><a class="nume-caracteristica">An fabricatie: </a> <span class="val-an-fabricatie"><?php echo $produs["an_fabricatie"]; ?></span></li>
                                        <li><a class="nume-caracteristica">Greutate: </a> <span class="val-greutate"><?php echo $produs["greutate"]; ?></span></li>
                                        <li><a class="nume-caracteristica">Culoare: </a> <span class="val-culoare"><?php echo $produs["culoare"]; ?></span></li>
                                        <li><a class="nume-caracteristica">Materiale: </a> <span class="val-materiale"><?php echo str_replace(array('[', '"', ']'), array("", "", ""), $produs["materiale"]); ?></span></li>
                                        <li><a class="nume-caracteristica">Resigilat: </a> <span class="val-resigilat"><?php echo $produs["resigilat"] ? "DA" : "NU"; ?></span></li>
                                        <li><a class="nume-caracteristica">Data adaugare: </a> 
                                            <span class="val-data-adaugare">
                                                <?php 
                                                    $data_adaugare = strtotime($produs["data_adaugare"]);
                                                    $timestamp_iso = date('c', $data_adaugare);
                                                    $data_iso = date('Y-m-d', $data_adaugare);
                                                ?>
                                                <time datetime="<?php echo $data_iso; ?>">
                                                    <script>
                                                        var d = new Date("<?php echo $timestamp_iso; ?>");
                                                        document.write(d.getDate() + " " + d.getMonthName() + " " + d.getFullYear());
                                                        document.write(" [" + d.getDayName() + "]");
                                                    </script>
                                                </time>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="item-dreapta">
                                    <div class="accordion" id="accordionExample<?php echo $produs["id"]; ?>">
                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="headingOne<?php echo $produs["id"]; ?>">
                                            <button id="accordion1Buton<?php echo $produs["id"]; ?>" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $produs["id"]; ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $produs["id"]; ?>">
                                              Categorie si Tip
                                            </button>
                                          </h2>
                                          <div id="collapseOne<?php echo $produs["id"]; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample<?php echo $produs["id"]; ?>">
                                            <div class="accordion-body">
                                                <p><a class="nume-caracteristica">Categorie: </a>  <span class="val-categorie"><?php echo $produs["categorie"]; ?></span></p>
                                                <p><a class="nume-caracteristica">Tip: </a>  <span class="val-tip"><?php echo $produs["tip_produs"]; ?></span></p>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="accordion-item">
                                          <h2 class="accordion-header" id="headingTwo<?php echo $produs["id"]; ?>">
                                            <button id="accordion2Buton<?php echo $produs["id"]; ?>" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo<?php echo $produs["id"]; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $produs["id"]; ?>">
                                              Descriere
                                            </button>
                                          </h2>
                                          <div id="collapseTwo<?php echo $produs["id"]; ?>" class="accordion-collapse collapse" aria-labelledby="headingTwo<?php echo $produs["id"]; ?>" data-bs-parent="#accordionExample<?php echo $produs["id"]; ?>">
                                            <div class="accordion-body">
                                                <span class="val-descriere"><?php echo $produs["descriere"]; ?></span></p>
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
                                </div>
                            </div>
                        </div>
                    </article>
                    <script>
                        document.getElementById("accordion1Buton<?php echo $produs["id"]; ?>").onclick = function() {
                            actualizeazaLocalStorage(1, "<?php echo $produs["id"]; ?>");
                        }
                        document.getElementById("accordion2Buton<?php echo $produs["id"]; ?>").onclick = function() {
                            actualizeazaLocalStorage(2, "<?php echo $produs["id"]; ?>");
                        }
                    </script>
                <?php } ?>
            </div>
        </section>
    </main>

    <?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
    </body>
</html>