<header>
    <script>
        var tema = localStorage.getItem("tema");
        if (tema) {
            document.body.classList.add("dark");
            this.innerHTML = 'Tema: <i class="fa-solid fa-moon"></i>';
        }
        else {
            document.body.classList.remove("dark");
            this.innerHTML = 'Tema: <i class="fa-solid fa-sun"></i>';
        }
    </script>
    <figure>
        <img sizes="(min-width:960px) 951px, (min-width:600px) 550px, 300px"
            srcset="/assets/logo/logo-web.png 951w, /assets/logo/logo-tablet.png 600w, /assets/logo/logo-phone.png 300w"
            src="/assets/logo/logo-phone.jpg"
            alt="calculatorultau">
    </figure>
    <h1 id="htitle">CalculatorulTau</h1>
    <nav>  
        <label id="hamburger" for="ch-menu">
            <img src="/assets/img/Hamburger_icon_alb.png" alt="menu">
        </label>
        <input id="ch-menu" type="checkbox">
        <ul class="meniu" id="meniul">
            <li><a href="/"><div id="acasa">Acasa</div><div id="casuta"><i class="fas fa-house"></div></i></a>
                <ul>
                    <li><a href="/#firstsection">Despre noi</a></li>
                    <li><a href="/#secondsection">Resurse</a></li>
                    <li><a href="/#thirdsection">Sectiuna trei</a></li>
                </ul>
            </li>
            <li><div><a href="/despre">Despre</a></div>
                <ul>                        
                    <li><a href="/despre#prezentare">Prezentare</a></li>
                    <li><a href="/despre#istoric">Istoric</a></li>
                    <li><a href="/despre#motivatie">Motivatie</a></li>
                    <li><a href="/despre#galerie-statica">Galerie</a></li>
                </ul>
            </li>
            <li><div><a href="/produse">Produse</a></div>
                <ul>
                    <?php 
                        // require_once getenv('APP_ROOT_PATH') . '/functions/database/sql_repository.php';

                        $mysqli = SQLRepository::getInstance()->getConnection();
                        $result = $mysqli->query("SELECT DISTINCT categorie FROM produse");

                        while($categorie = $result->fetch_assoc()) { 
                            $nume_categorie = $categorie["categorie"];
                            $uppcase = ucfirst($nume_categorie);
                            echo "<li><a href=\"/produse?categorie=$nume_categorie\">$uppcase</a></li>";
                        }
                    ?>
                </ul>
            </li>
            <!-- <% if(locals.utilizator && locals.utilizator.rol=="admin") { %> -->
            <!-- <li><a href="/useri">Useri</a></li> -->
            <!-- <% } %> -->
            <li><a id="btn_tema">Tema: <i class="fa-solid fa-sun"></i></a></li>
            <li><a href="#">Contact</a></li>
            <?php if(isset($_SESSION["user_id"])) : 
                    require_once getenv('APP_ROOT_PATH') . '/functions/database/db_functions.php';
                    $user = getUserInfo($_SESSION["user_id"]);    
            ?>
                <li><div id="username-button"> <img src="/profilepicture" width="32" height="32" onerror="this.style.display = 'none';"> <?php echo $user["username"]; ?></div>
                    <ul>
                        <li><a href="/profil">Profil</a></li>
                        <li><a href="/logout">Logout</a></li>
                        <li><a href="/stergere">Stergere cont</a></li>
                    </ul>
                </li>
                <script>
                    document.getElementById("username-button").addEventListener("mouseover", function() {
                        this.innerHTML = "<?php echo $user["prenume"] . " " . $user["nume"]; ?>";
                    });
                    document.getElementById("username-button").addEventListener("mouseout", function() {
                        this.innerHTML = "<img src=\"/profilepicture\" width=\"32\" onerror=\"this.style.display = 'none';\" height=\"32\"> <?php echo $user["username"]; ?>";
                    });
                </script>
            <?php else : ?>
            <li><a href="/inregistrare">Inregistrare</a></li>
            <li><a href="/cos-virtual">Cos</a></li>
            <li>
                <a href="#">Conectare</a>
                <ul>
                    <form id="form_inreg"  method="post" class="date"  action="/login/index.php"  enctype="multipart/form-data">
                            <label>
                                Username: <input type="text" name="username" id="inp-username" required pattern="[A-Za-z0-9]+">
                            </label>
                            <br>
                            <label>
                                Parola: <input id="parl" type="password" required  name="parola" value="">
                            </label>
                        <input type="submit" value="Conectare">
                    </form>
                </ul>
            </li> 
            <?php endif; ?>
        </ul>
    </nav>
    <!-- <p style="color: red; font-weight: bold;"><%- locals.mesajLogin %></p> -->
</header>