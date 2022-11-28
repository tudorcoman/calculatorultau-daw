
window.addEventListener("load", function() {

    // bifare elemente din cosul virtual (localStorage)

    iduriProduse = localStorage.getItem("cos_virtual");
    if (iduriProduse) {
        iduriProduse = iduriProduse.split(",");
    } else {
        iduriProduse = [];
    }

    for (let id_p of iduriProduse) {
        var ch = document.querySelector(`input.select-cos[value='${id_p}']`);
        if (ch) {
            ch.checked = true;
        }
    }

    for (let article of document.getElementsByTagName("article")) {
        let productId = article.id.substring(5);

        var stare1 = localStorage.getItem(`accordion-1-${productId}`);
        if (stare1) {
            this.document.getElementById(`accordion1Buton${productId}`).classList.toggle("collapsed");
            this.document.getElementById(`collapseOne${productId}`).classList.toggle("show");
        }

        var stare2 = localStorage.getItem(`accordion-2-${productId}`);
        if (stare2) {
            this.document.getElementById(`accordion2Buton${productId}`).classList.toggle("collapsed");
            this.document.getElementById(`collapseTwo${productId}`).classList.toggle("show");
        }
    }
    document.getElementById("inp-pret").onchange = function() {
        document.getElementById("infoRange").innerHTML = " (" + this.value + ")";
    }

    document.getElementById("filtrare").onclick = function() {
        var valNume = document.getElementById("inp-nume").value.toLowerCase();
        
        var butoaneRadio = document.getElementsByName("gr_rad");
        for(let rad of butoaneRadio) {
            if (rad.checked) {
                var valGreutate = rad.value;
                break;
            }
        }

        var valPret = document.getElementById("inp-pret").value;
        var valTip = document.getElementById("inp-tip").value;

        if (valGreutate != "toate") {
            var minGreutate, maxGreutate;
            [minGreutate, maxGreutate] = valGreutate.split(":");
            minGreutate = parseInt(minGreutate);
            maxGreutate = parseInt(maxGreutate);
        } else {
            minGreutate = 0;
            maxGreutate = 1000000000;
        }

        var valAn = document.getElementById("inp-an").value;
        if (valAn != "") {
            var an;
            an = parseInt(valAn);
        }
        
        var valTextarea = document.getElementById("inp-descriere").value.toLowerCase();

        var articole = document.getElementsByClassName("produs");

        var divMateriale = document.getElementById("filtru-materiale");
        const mapaFiltreMateriale = new Map();

        var culoriPosibile = [];
        for (let optiune of document.getElementById("inp_culoare").getElementsByTagName("option")) {
            if (optiune.selected)
                culoriPosibile.push(optiune.value);
        }

        for (let inputTag of divMateriale.getElementsByTagName("input")) {
            if(inputTag.id.startsWith("inp-") && inputTag.checked) {
                let material = inputTag.id.slice(4);
                let inputAre = document.getElementById("i_rad1_" + material);
                let inputNare = document.getElementById("i_rad2_" + material);

                if (inputAre.checked) {
                    mapaFiltreMateriale.set(material, true);
                } else if (inputNare.checked) {
                    mapaFiltreMateriale.set(material, false);
                }
            }
        }

        for (let art of articole) {
            art.style.display = "none";
            let numeArt = art.getElementsByClassName("val-nume")[0].innerHTML.toLowerCase();
            let cond1 = (numeArt.startsWith(valNume));

            let greutateArt = parseInt(art.getElementsByClassName("val-greutate")[0].innerHTML);
            let cond2 = (minGreutate <= greutateArt && greutateArt < maxGreutate);

            let pretArt = parseFloat(art.getElementsByClassName("val-pret")[0].innerHTML);
            let cond3 = (valPret <= pretArt);

            let tipArt = art.getElementsByClassName("val-tip")[0].innerHTML;
            let cond4 = (valTip == tipArt || valTip == "toate");
            
            let anArt = parseInt(art.getElementsByClassName("val-an-fabricatie")[0].innerHTML);
            let cond5 = (!an || anArt == an);

            let culoare = art.getElementsByClassName("val-culoare")[0].innerHTML;
            let cond6 = (culoriPosibile.length == 0 || culoriPosibile.includes(culoare));

            let descriereArt = art.getElementsByClassName("val-descriere")[0].innerHTML.toLowerCase();
            let cond7 = (descriereArt.includes(valTextarea));
            
            let materiale = art.getElementsByClassName("val-materiale")[0].innerHTML.split(",");

            let cond8 = true;
            for (const material of mapaFiltreMateriale) {
                if (material[1] == true) {
                    cond8 = cond8 && (materiale.includes(material[0]));
                } else {
                    cond8 = cond8 && (!materiale.includes(material[0]));
                }
            }

            let conditieFinala = (cond1 && cond2 && cond3 && cond4 && cond5 && cond6 && cond7 && cond8); 
            if(conditieFinala)
                art.style.display = "block";
        }
    }

    document.getElementById("resetare").onclick = function() {
        var articole = document.getElementsByClassName("produs");
        for (let art of articole) {
            art.style.display = "block";
        }

        document.getElementById("inp-nume").value = "";
        document.getElementById("i_rad4").checked = true;
        document.getElementById("inp-pret").value = 0;
        document.getElementById("infoRange").innerHTML = "(0)";
        document.getElementById("sel-toate").selected = true;
        document.getElementById("inp-an").value = "";
        document.getElementById("inp-descriere").value = "";

        var divMateriale = document.getElementById("filtru-materiale");
        for (let inputTag of divMateriale.getElementsByTagName("input")) {
            if (inputTag.id.startsWith("i_rad1"))
                inputTag.checked = true;
            else
                inputTag.checked = false;
        }

        for (let optionTag of document.getElementById("inp_culoare").getElementsByTagName("option"))
            optionTag.selected = false;
    }

    document.getElementById("sortCrescNume").onclick = function() {
        sorteaza(1);
    }

    document.getElementById("sortDescrescNume").onclick = function() {
        sorteaza(-1);
    }

    /*window.onkeydown = function(e) {
        console.log(e);
        if(e.key == 'c' && e.ctrlKey) {
            fa_suma();
        }
    }*/

    document.getElementById("calculSuma").onclick = fa_suma;


    // ==================== cos virtual ====================
/*
    var checkboxuri = document.getElementsByClassName("select-cos");
    for (let ch of checkboxuri) {
        ch.onchange = function() {
            iduriCos = localStorage.getItem("cos_virtual"); // 1, 5, 3
            // hint pentru cantitate "1|20,5|10,..."
            if(!iduriCos)
                iduriCos = [];
            else {
                iduriCos = iduriCos.split(",");
            }

            if (this.checked) {
                iduriCos.push(this.value);
            } else {
                var poz = iduriCos.indexOf(this.value);
                if (poz != -1)
                    iduriCos.splice(poz, 1);
            }
            localStorage.setItem("cos_virtual", iduriCos.join(","));
        }
    }
    */
})

function sorteaza(ord) {
    var articole = document.getElementsByClassName("produs");
    var v_articole = Array.from(articole);

    /*v_articole.sort(function(a, b) {
        let nume_a = a.getElementsByClassName("val-nume")[0].innerHTML;
        let nume_b = b.getElementsByClassName("val-nume")[0].innerHTML;
        let comp = nume_a.localeCompare(nume_b);

        if (comp != 0)
            return ord * comp;
        else {
            // se activeaza a doua cheie de sortare: pret
            let pret_a = parseFloat(a.getElementsByClassName("val-pret")[0].innerHTML);
            let pret_b = parseFloat(b.getElementsByClassName("val-pret")[0].innerHTML);
            return ord * (pret_a - pret_b);
        }
    })*/

    v_articole.sort(function(a, b) {
        let a_c1 = calcul_c1(a), b_c1 = calcul_c1(b);
        if (a_c1 == b_c1) {
            let a_c2 = calcul_c2(a), b_c2 = calcul_c2(b);
            return ord * a_c2.localeCompare(b_c2);
        }
        return ord * (a_c1 - b_c1);

    })

    for (let art of v_articole) {
        art.parentElement.appendChild(art);
    }
}

function fa_suma() {
    if (! document.getElementById("psuma")) {
        let suma = 0;
        var articole = document.getElementsByClassName("produs");
        for (let art of articole) {
            if (art.style.display != "none")
                suma += parseFloat(art.getElementsByClassName("val-pret")[0].innerHTML);
        }
        var pSuma = document.createElement("p");
        pSuma.innerHTML = "<b> Suma: </b>" + suma + " RON";
        pSuma.id = "psuma";
        var sectiune = document.getElementById("produse");
        sectiune.parentElement.insertBefore(pSuma, sectiune);
        setTimeout(function() {
            let p = document.getElementById("psuma");
            if (p)
                p.remove();
        }, 2000);
    }
}

function calcul_c1(a) {
    return 1.0 * parseInt(a.getElementsByClassName("val-an-fabricatie")[0].innerHTML) / parseFloat(a.getElementsByClassName("val-pret")[0].innerHTML);
}

function calcul_c2(a) {
    return a.getElementsByClassName("val-tip")[0].innerHTML;
}

function actualizeazaLocalStorage(i, productId) {
    var numeItem = `accordion-${i}-${productId}`;
    var stare = localStorage.getItem(numeItem);
    if (stare) {
        localStorage.removeItem(numeItem);
    } else {
        localStorage.setItem(numeItem, "open");
    }
}

(function() {
    var days = ['Duminica','Luni','Marti','Miercuri','Joi','Vineri','Sambata'];

    var months = ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Iulie','August','Septembrie','Octombrie','Noiembrie','Decembrie'];

    Date.prototype.getMonthName = function() {
        return months[ this.getMonth() ];
    };
    Date.prototype.getDayName = function() {
        return days[ this.getDay() ];
    };
})();