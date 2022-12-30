window.addEventListener('load', function() {
	$.ajax(({
		type: 'GET',
		url: '/produse/get.php',
		data: {},
		success: function(produse_db) {
			let main = document.getElementById("continut-pagina");

			var produse_ls = localStorage.getItem('cos_virtual');
			document.getElementById("cos").value = produse_ls;

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
    				
					let sectiune = document.getElementById("sectiune-cos");
					let tabel = document.createElement("table");
					tabel.innerHTML = "<tr><th>Nume produs</th><th>Imagine</th><th>Cantitate</th><th>Pret unitar</th><th>Pret total</th></tr>";
					
					var totalCos = 0; 
    				for (let prod of produse){
						let rand = document.createElement("tr");
    					
						let nume = document.createElement("td");
						nume.innerHTML = prod.nume;

						let imagine = document.createElement("td");
						let img = document.createElement("img");
						img.src = prod.imagine;
						img.style.width = "100px";
						imagine.appendChild(img);

						let cantitate = document.createElement("td");
						cantitate.innerHTML = produseQ.get(prod.id).toString();

						let pretUnitar = document.createElement("td");
						pretUnitar.innerHTML = prod.pret.toString();

						let pretTotal = produseQ.get(prod.id) * prod.pret;
						let total = document.createElement("td");
						totalCos += pretTotal;
						total.innerHTML = pretTotal.toString();
						
						rand.appendChild(nume);
						rand.appendChild(imagine);
						rand.appendChild(cantitate);
						rand.appendChild(pretUnitar);
						rand.appendChild(total);

;						tabel.appendChild(rand);		
    				}

					sectiune.appendChild(tabel);
					let total = document.createElement("p");
					total.innerHTML = "Total: " + totalCos.toString();
					sectiune.appendChild(total);
    			}
			} else {
				main.innerHTML="<p>Nu aveti nimic in cos!</p>";
			}
		}
	}))
});

function curataCos() {
	localStorage.setItem("cos_virtual", "");
}
