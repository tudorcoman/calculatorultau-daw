<?php 
    session_start();
    require_once getenv('APP_ROOT_PATH') . "/functions/database/db_functions.php";

    if(!isset($_SESSION["user_id"])) {
        header("Location: /");
        die();
    }
    
    $user = getUserInfo($_SESSION["user_id"]);
    if(strcmp($user["rol"], "admin")) {
        header("Location: /");
        die();
    }
    
    function export_excel($data, $columns, $filename = 'export_excel') {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        include 'vendor/autoload.php';

        $file = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $active_sheet = $file->getActiveSheet();

        for($i = 0; $i < count($columns); $i ++) {
            $active_sheet->setCellValueByColumnAndRow($i, 1, $columns[$i]);
        }

        $row = 2;
        foreach($data as $data_row) {
            $col = 0;
            foreach($data_row as $data_col) {
                $active_sheet->setCellValueByColumnAndRow($col, $row, $data_col);
                $col ++;
            }
            $row ++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($file);
        ob_end_clean();
        $writer->save('php://output');

        exit;
    }

    if(isset($_POST["export_gestiune"])) {
        $data = getGestiuneReport();
        $columns = array("Depozit", "Produs", "Cantitate");
        export_excel($data, $columns, "gestiune");
    }

    if(isset($_POST["export_comenzi"])) {
        $data = getComenziReport($_POST["select_comenzi"]);
        $columns = array("Numar comanda", "Utilizator", "Data comenzii", "Valoare");
        export_excel($data, $columns, "comenzi");
    }
?>

<!DOCTYPE html>
<html  lang="ro">
    <head>
        <meta name="keywords" content="componente calculator, componente PC, procesoare, placi video, CPU, GPU, HDD, SSD, periferice, accesorii PC, procesoare, memorii, hard disk uri, placi de baza, carcase, unitati optice, ventilatoare carcasa, surse, conectica">
        <meta name="description" content="Cel mai bun loc pentru componente de PC, de la A la Z.">
        <link rel="stylesheet" href="/assets/css/cos-virtual.css" type="text/css" />
        <title>CalculatorulTau - dashboard admin</title>
        <?php include(getenv('APP_ROOT_PATH') . "/templates/head.php"); ?>  
        <link rel="stylesheet" href="/assets/css/formular.css" type="text/css" />
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            .week {
                display: none;
            }

            .month {
                display: none; 
            }
            
            .dropdown {
                width: 50%;
            }
        </style>
    </head>
    <body>
    <?php 
        include(getenv('APP_ROOT_PATH') . "/templates/header.php"); 
    ?>

    <script>
    function changeComenzi(granularity) {
        var day = document.getElementsByClassName("day");
        var week = document.getElementsByClassName("week");
        var month = document.getElementsByClassName("month");

        if(granularity == "day") {
            for(var i = 0; i < day.length; i++) {
                day[i].style.display = "table-row";
            }
            for(var i = 0; i < week.length; i++) {
                week[i].style.display = "none";
            }
            for(var i = 0; i < month.length; i++) {
                month[i].style.display = "none";
            }
        } else if(granularity == "week") {
            for(var i = 0; i < day.length; i++) {
                day[i].style.display = "none";
            }
            for(var i = 0; i < week.length; i++) {
                week[i].style.display = "table-row";
            }
            for(var i = 0; i < month.length; i++) {
                month[i].style.display = "none";
            }
        } else if(granularity == "month") {
            for(var i = 0; i < day.length; i++) {
                day[i].style.display = "none";
            }
            for(var i = 0; i < week.length; i++) {
                week[i].style.display = "none";
            }
            for(var i = 0; i < month.length; i++) {
                month[i].style.display = "table-row";
            }
        }
    }


    </script>
    <main>
        <h1>Dashboard Admin</h1>
        <div id="continut-pagina">
            <section>
                <h2>Utilizatori online</h2>
                <table>
                    <tr>
                        <th>Username</th>
                    </tr>
                    <?php
                        $users = getOnlineUsersReport();
                        foreach($users as $user) {
                            echo "<tr>";
                            echo "<td>" . $user . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </section>

            <section>
                <h2>Accesari</h2>
                <table>

                    <tr>
                        <th>Timp</th>
                        <th>Numar adrese IP</th>
                    </tr>
                    <?php
                        $accesses = getAccesariReport();
                        foreach($accesses as $access) {
                            echo "<tr>";
                            echo "<td>" . $access["timp"] . "</td>";
                            echo "<td>" . $access["ip"] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </section>
            <section>
                <h2>Gestiune</h2>
                <form method="POST">
                    <input type="submit" name="export_gestiune" value="Export Excel">
                </form>
                <br>
                <table>
                    <tr>
                        <th>Id depozit</th>
                        <th>Id produs</th>
                        <th>Cantitate</th>
                    </tr>
                    <?php
                        $gestiune = getGestiuneReport();
                        foreach($gestiune as $item) {
                            echo "<tr>";
                            echo "<td>" . $item["id_depozit"] . "</td>";
                            echo "<td>" . $item["id_produs"] . "</td>";
                            echo "<td>" . $item["cantitate"] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </section>
            <section>
                <h2>Comenzi</h2>
                <form method="POST">
                    <select name="select_comenzi" id="select_comenzi" class="dropdown" onchange="changeComenzi(this.value)">
                    <option value="day">Zi</option>
                    <option value="week">Saptamana</option>
                    <option value="month">Luna</option>
                </select>
                <br>
                    <input type="submit" name="export_comenzi" value="Export Excel">
                </form>
                <br>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Id user</th>
                        <th>Valoare</th>
                    </tr>
                    <?php
                        $daily_orders = getComenziReport("day");
                        foreach($daily_orders as $order) {
                            echo '<tr class="day">';
                            echo "<td>" . $order["id"] . "</td>";
                            echo "<td>" . $order["beneficiar"] . "</td>";
                            echo "<td>" . $order["valoare"] . "</td>";
                            echo "</tr>";
                        }

                        $weekly_orders = getComenziReport("week");
                        foreach($weekly_orders as $order) {
                            echo '<tr class="week">';
                            echo "<td>" . $order["id"] . "</td>";
                            echo "<td>" . $order["beneficiar"] . "</td>";
                            echo "<td>" . $order["valoare"] . "</td>";
                            echo "</tr>";
                        }

                        $monthly_orders= getComenziReport("month");
                        foreach($monthly_orders as $order) {
                            echo '<tr class="month">';
                            echo "<td>" . $order["id"] . "</td>";
                            echo "<td>" . $order["beneficiar"] . "</td>";
                            echo "<td>" . $order["valoare"] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </section>
        </div>
    </main>

    <?php include(getenv('APP_ROOT_PATH') . "/templates/footer.php"); ?>
    </body>
</html>