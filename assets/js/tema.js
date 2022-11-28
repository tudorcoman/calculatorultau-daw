window.addEventListener("load", function() {
    document.getElementById("btn_tema").onclick = function() {
        var tema = localStorage.getItem("tema");
        if (tema) {
            localStorage.removeItem("tema");
            this.innerHTML = 'Tema: <i class="fa-solid fa-sun"></i>';
        } else {
            localStorage.setItem("tema", "dark");
            this.innerHTML = 'Tema: <i class="fa-solid fa-moon"></i>';
        }
        document.body.classList.toggle("dark");
    }
})