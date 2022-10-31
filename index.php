<!DOCTYPE html>
<html>
  <?php 
    require 'head.php';
    echo generate_head('Proiect DAW', 'Tema 1 curs optional Dezvoltarea Aplicatiilor Web');
  ?>

  <body onload="makeNthMenuElementActive(0)">
    <?php include("header.php"); ?>
    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">Descrierea scenariului</h1>
      <p class="lead">
        CalculatorulTau este o firma specializata in comertul online (prin propriul sau magazin online) al componentelor de calculatoare personale. Clientii acestei companii sunt in general oameni care doresc sa isi asambleze singuri calculatorul personal, sau pot fi si firme care au nevoie de calculatoare pentru angajatii proprii.
      </p>

      <p class="lead">CalculatorulTau trimite comenzile prin intermediul mai multor depozite la nivel national, fiind o firma prezenta in mai multe orase. Prin acest magazin online, compania ar trebui sa poata sa se ocupe si de facturarea si de mentinerea gestiunii produselor. </p>

      <p class="lead">Evidenta gestiunii produselor se face prin intermediul bazei de date, gestionandu-se informati referitoare la produsele care se afla pe stocul fiecarui depozit. In momentul in care o comanda este expediata catre client (si automat factura este emisa), gestiunea va fi descarcata. </p>

      <p class="lead">Reprezentarea necesitatilor companiei trebuie realizata astfel incat sa fie un model cat mai apropiat de modul in care se desfasoara activitatile ei. Flowul prin care trece utilizatorul, dar si datele care sunt stocate, trebuie sa permita o executare cat mai eficienta a actiunilor dorite. </p>
    </main>

    <?php include("footer.php"); ?>
  </body>
</html>