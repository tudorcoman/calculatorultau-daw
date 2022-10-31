function makeNthMenuElementActive(n) {
    var noduri = document.getElementById("navbarCollapse").childNodes[1].childNodes;
    noduri[2 * n + 1].className = "nav-item active";
}