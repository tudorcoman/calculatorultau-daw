<!DOCTYPE html>
<html>
<?php 
    require 'head.php';
    echo generate_head('Proiect DAW - baza de date', 'Tema 1 curs optional Dezvoltarea Aplicatiilor Web');
  ?>

  <body onload="makeNthMenuElementActive(2)">
    <?php include("header.php"); ?>
    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">Baza de date</h1>
      <p class="lead">
        Baza de date va contine informatii legate de utilizatori, produse, clienti, promotii, facturi si gestiune. Asadar, in urma comenzilor facute de catre utilizatorii care sunt clienti, gestiunea trebuie sa fie actualizata automat de catre aplicatia web. Totodata, administratorii web vor avea acces catre pagini pe care utilizatorii clienti nu le pot vedea (pagini de administrare a gestiunii si a produselor). 
      </p>
      <p class="lead">
        Un produs se poate afla pe mai multe comenzi, dar si o comanda poate avea mai multe produse, asa ca am adaugat o entitate asociativa. In acelasi timp, o comanda poate cuprinde produse aflate in mai multe depozite. Pentru pastrarea istoricului gestiunii, am adaugat o entitate asociativa care sa tina toate tranzactiile facute cu un produs intre 2 depozite (sau din exterior/interior, in cazul intrarilor, respectiv iesirilor). 
      </p>
      <h1 class="mt-5">Diagrama conceptuala</h1>
      <iframe width="1120" height="630" src='https://dbdiagram.io/embed/635ec14e5170fb6441c2e4e1'> </iframe>
    </main>

    <?php include("footer.php"); ?>
  </body>
</html>