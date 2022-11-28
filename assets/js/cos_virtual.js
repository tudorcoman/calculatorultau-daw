window.addEventListener('load', function() {
	$.ajax(({
		type: 'GET',
		url: '/produse/get.php',
		data: {},
		success: function(produse_db) {
			var produse_ls = localStorage.getItem('cos_virtual');
			if (produse_ls) {
			    produse_ls = produse_ls.split(',');
    			var produseId = [];
    			const produseQ = new Map();
    			for (let prod of produse_ls) {
    				var date = prod.split('|');
    				produseId.push(date[0]);
    				produseQ.set(date[0], parseInt(date[1]));
    			}
    
    			produse = produse_db.filter(produs => produseId.includes(produs.id));
    			if (produse.length > 0) {
    				let main = document.getElementsByTagName("main")[0];
    				let btn = document.getElementById("cumpara");
    		
    				for (let prod of produse){
    					let article = document.createElement("article");
    					article.classList.add("cos-virtual");
    					var h2 = document.createElement("h2");
    					h2.innerHTML = prod.nume;
    					article.appendChild(h2);
    					let imagine = document.createElement("img");
    					imagine.src = prod.imagine;
    					article.appendChild(imagine);
    		
    					let descriere = document.createElement("p");
    					descriere.innerHTML = prod.descriere + " <b>Pret: </b>" + prod.pret;
    					article.appendChild(descriere);
    					main.insertBefore(article, btn);
    					
    					/* TO DO 
    					pentru fiecare produs, creăm un articol in care afisam imaginea si cateva date precum:
    					- nume, pret, imagine, si alte caracteristici
    		
    					
    					document.getElementsByTagName("main")[0].insertBefore(divCos, document.getElementById("cumpara"));
    					*/

						// aici trebuie facut un tabel
						// si la final un formular de order
						// daca nu e logat, trimite-l catre creare cont 
						// daca e logat, ia adresa si trimite comanda
    				}
    			}
			} else {
				document.getElementsByTagName("main")[0].innerHTML="<p>Nu aveti nimic in cos!</p>";
			}
		}
	}))
});