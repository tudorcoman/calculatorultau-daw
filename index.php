<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <title>CalculatorulTau</title>
    <!-- <meta charset="UTF-8"> -->
    <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
    <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
    <meta name="author" content="Tudor Coman">
    <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>
    <link rel="stylesheet" href="/assets/css/tabel.css" type="text/css">
    <!-- <link rel="stylesheet" href="/galerie-animata.css" type="text/css"> -->
</head>
<body>
<?php include(getenv('APP_ROOT_PATH') . "/templates/header.php"); ?>
<p id="watermark"></p>
<main class="wrapper">
    <div id="sectiune1">
        <section id="firstsection">
            <h2>Despre noi</h2>
            <p>
                Pe calculatorultau.ro gasesti orice componente de PC, precum <b>procesoare</b>, <b>placi video</b>, <b>placi de baza</b> si <b>hard diskuri</b>, dar si <b>periferice</b> si <b>accesorii</b> de PC. Daca nu esti sigur de ce anume ai nevoie, trimite-ne un mail sau suna-ne la numarul de telefon de mai jos, pentru a beneficia de o consultanta gratuita. Suntem prezenti pe piata pieselor de calculatoare de 10 ani, asa ca stim ce sa recomandam pentru nevoile oricarui client. 
            </p>

            <!-- <p>
                <button id="btn_tema">Schimba tema</button>
            </p> -->

            <video width="640" height="480" controls="controls" poster="/assets/img/motherboard.jpg">
                <source src="/assets/video/video.mov" type="video/mov">
                <source src="/assets/video/video.mp4" type="video/mp4">
                <source src="/assets/video/video.ogv" type="video/ogv">
                <track default src="/assets/tracks/caption_ro.vtt" kind="captions" srclang="ro" label="romana" />
                <track  src="/assets/tracks/caption_en.vtt" kind="captions" srclang="en" label="engleza" />
            </video>
            
        </section>

        <section id="faq">
            <h2>Intrebari frecvente</h2>
            <details><summary>Cat costa livrarea?</summary>
                <p>Livrarea este gratuita pentru comenzile de peste 500 de RON. In cazul in care comanda este sub aceasta valoare, va fi perceputa o taxa de <s>25 de RON</s><ins>20 de RON</ins>. </p>
            </details>
            <details><summary>Cum livrati comenzile si in ce zone?</summary>
                <p>Livram cu curier rapid in toata tara. Partenerii nostri sunt FAN Courier si DPD.</p>
            </details>
            <details><summary>Care este procedura de retur?</summary>
                <p>Returul poate fi facut la 30 de zile de la achizitie, in cazul in care bunurile nu au fost folosite si sunt in ambalajul original. Dupa inspectarea produselor, banii vor fi restituiti prin transfer bancar.</p>
            </details>
        </section>

    </div>

    <div id="sectiune2">
        <!-- <h4>Tabel</h4> -->
        <!-- <br> -->
        <strong>
            <i class="fa-solid fa-triangle-exclamation fa-fade"></i>
            Atentie! Chiar daca procesarea comenzilor se face timp de 24 de ore, livrarea nu se va face in aceeasi zi. 
        </strong>
        <br />
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p> -->

        <div id="container_tabel">
            <table id="tabelul">
                <caption>Program de lucru</caption>
                <thead>
                <tr>
                  <th>Zi</th>
                  <th>Procesare Comenzi</th>
                  <th>Livrari</th> 
                  <th>Suport</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Luni</td>
                    <td rowspan="7">00:00-24:00</td> 
                    <td rowspan="5">10:00-16:00</td>
                    <td rowspan="5">08:00-20:00</td>
                </tr>
                <tr>
                    <td>Marti</td>
                    <!-- <td>00:00-24:00</td>  -->
                    <!-- <td>10:00-16:00</td> -->
                    <!-- <td>08:00-20:00</td> -->
                </tr>
                <tr>
                    <td>Miercuri</td>
                    <!-- <td>00:00-24:00</td>  -->
                    <!-- <td>10:00-16:00</td> -->
                    <!-- <td>08:00-20:00</td> -->
                </tr>
                <tr>
                    <td>Joi</td>
                    <!-- <td>00:00-24:00</td>  -->
                    <!-- <td>10:00-16:00</td> -->
                    <!-- <td>08:00-20:00</td> -->
                </tr>
                <tr>
                    <td>Vineri</td>
                    <!-- <td>00:00-24:00</td>  -->
                    <!-- <td>10:00-16:00</td> -->
                    <!-- <td>08:00-20:00</td> -->
                </tr>
                <tr>
                    <td>Sambata</td>
                    <!-- <td>00:00-24:00</td>  -->
                    <td>10:00-13:00</td>
                    <td>09:00-16:00</td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Duminica</td>
                        <td>00:00-22:00</td> 
                        <td>Inchis</td>
                        <td>Inchis</td>
                    </tr>
                </tfoot>
              </table>
        </div>
    </div>
    <div id="sectiune3">
        <h4>Calendar de evenimente</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p>
    </div>
    <div id="sectiune4">
        <h4>Anunturi</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p>    </div>

    <div id="sectiune5">
        <h4>Utilizatori online</h4>
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p> -->
        <ul id="utilizatori_online"></ul>
        <!-- <script>
            var listaNeordonata = document.getElementById("utilizatori_online");
            fetch("/admini_online")
                .then(response => response.json())
                .then(data => {
                    for (let user of data) {
                        var li = document.createElement("li");
                        li.innerHTML = `${user.username} (<a href="mailto:${user.email}">${user.email}</a>)`;
                        listaNeordonata.appendChild(li);
                    }
                });
        </script> -->
    </div>
    <div id="sectiune6">
        <h4>Date despre utilizatori si statistici</h4>
        <p>IP: </p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p>
    </div>
    <div id="sectiune7">
        <h4>Date despre site si server</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum nec tortor risus. Mauris hendrerit tellus at dolor tincidunt, non feugiat felis mollis. Curabitur lacus sem, iaculis eu consequat eu, hendrerit ut lectus. Maecenas dictum tempus diam, ornare bibendum massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vel elit ac magna consectetur pellentesque. Pellentesque tempus arcu elit, at convallis elit eleifend sed. Pellentesque aliquet lacus orci, in sagittis est convallis et. Ut pharetra, metus vitae blandit malesuada, turpis ex vulputate odio, ac convallis libero erat sed nunc. Praesent ut magna est. Mauris sit amet iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus ullamcorper nisi id urna ultricies suscipit. Sed dignissim, mauris sit amet viverra imperdiet, velit leo viverra arcu, ut vehicula sapien metus sed nibh.</p>
    </div>

    <div id="sectiune8">
        <section id="secondsection">
            <h2>Resurse</h2>
            <p>In cazul in care nu esti hotarat ce componente de calculator iti doresti, noi am alcatuit o lista de resurse pe care sa o poti consulta: </p>
            <p><a href="/assets/ghid.pdf" download>Ghid asamblare PC pentru incepatori</a></p>
            <br />
            <br />
            <section id="iframe-container">
                <div class="taburi-iframe">
                    <a href="https://www.youtube.com/embed/_eagZ1VS3rg" target="ifr-video">Intel vs AMD</a>
                    <a href="https://www.youtube.com/embed/2DGlgjcOXF8" target="ifr-video">Top 5</a>
                    <!-- <a href="https://www.youtube.com/embed/Wtxbt-CpA2s" target="ifr-video" >Reteta tort căpșuni</a><br/> -->
                </div>
            <!-- <p>Videouri: Intel vs AMD</a> | Top 5 best motherboards</a></p> -->
            
                <iframe name="ifr-video" width="560" height="315" src="https://www.youtube.com/embed/_eagZ1VS3rg" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </section>
                <section>
                    <p>Acest site foloseste cookies. Continuarea navigarii implica acceptarea lor. Citeste <a href="https://gdpr.eu/cookies/" target="_blank"> aici</a> mai multe despre cookies. </p>
                </section>
        </section>
    </div>
</main>
<?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
</body>
</html>
