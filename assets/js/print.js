window.addEventListener("beforeprint", function(event) {
    document.getElementById("meniul").parentElement.setAttribute("style", "page-break-after: always;");
    document.getElementById("meniul").setAttribute("class", "clasaprint-meniu");
    document.getElementById("casuta").setAttribute("style", "display: none;");
    document.getElementById("acasa").setAttribute("style", "display: block;");
});

window.addEventListener("afterprint", function(event) {
    document.getElementById("meniul").setAttribute("class", "meniu");
    document.getElementById("casuta").removeAttribute("style");
    document.getElementById("acasa").removeAttribute("style");
})