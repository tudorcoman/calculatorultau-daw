<!DOCTYPE html>
<html>
  <?php 
    require getenv('APP_ROOT_PATH') . '/templates/prezentare/head.php';
    echo generate_head('Proiect DAW - functionalitati', 'Tema 1 curs optional Dezvoltarea Aplicatiilor Web');
  ?>

  <body onload="makeNthMenuElementActive(1)">
    <?php include(getenv('APP_ROOT_PATH') . "/templates/prezentare/header.php"); ?>
    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">Functionalitati</h1>
      <p class="lead">
      Principala functionalitate a magazinului online este, in mod evident, posibilitatea clientilor de a plasa comenzi ce vor fi facturate si livrate lor. Factura va fi trimisa pe mail in momentul efectuarii comenzii. Comenzile pot folosi un cod de reducere activ, in cazul promotiilor. 
      </p>
      <p class="lead">
      Din moment ce singurul canal de vanzari al companiei CalculatorulTau este acest magazin online, dorim sa avem si un sistem de gestiune ce tine stocurile produselor la zi, in functie de fiecare depozit. 
      </p>
      <p class="lead"> 
      Atat utilizatorii care plaseaza comenzi, cat si cei care administreaza website-ul, au un utilizator, o parola, un nume, un email si un numar de telefon asociate, pentru a putea accesa site-ul web. In momentul in care un client se inregistreaza, un link va fi trimis pe email pentru activarea contului.
      </p>
    </main>

    <?php include(getenv('APP_ROOT_PATH') . "/templates/prezentare/footer.php"); ?>
  </body>
</html>