function setCookie(nume, val, timpExp, path = "/") { // timpExp e dat in ms
    d = new Date();
    d.setTime(d.getTime() + timpExp);
    document.cookie = `${nume}=${val}; expires= ${d.toUTCString()}; path=${path}`;
}

function getCookie(nume) {
    v_cookie = document.cookie.split(";");
    for(let c of v_cookie) {
        c = c.trim();
        if(c.startsWith(nume + "="))
            return c.substring(nume.length + 1);
    }
}

function deleteCookie(nume) {
    setCookie(nume, "", 0);
}

function deleteAllCookies(nume) {
    v_cookie = document.cookie.split(";");
    for(let c of v_cookie) {
        c = c.trim();
        deleteCookie(c.split("=")[0]);
    }
}

function checkBanner() {
    let val_cookie = getCookie("acceptat_banner");
    if (val_cookie) {
        document.getElementById("banner").style.display = "none";
    } else {
        document.getElementById("banner").style.display = "block";
        document.getElementById("ok_cookies").onclick = function() {
            setCookie("acceptat_banner", "true", 5000);
            document.getElementById("banner").style.display = "none";
        }
    }
}

window.addEventListener("DOMContentLoaded", function() {
    checkBanner();
})