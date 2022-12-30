SELECT id_depozit, id_produs, SUM(t.cantitate) AS cantitate
FROM (    
   	SELECT id_depozit, id_produs, -cantitate AS cantitate FROM linie_produs_comanda
    UNION
    SELECT id_depozit_iesire, id_produs, -cantitate AS cantitate FROM tranzactii_produse 
    UNION 
    SELECT id_depozit_intrare, id_produs, cantitate FROM tranzactii_produse
    UNION 
    SELECT id_depozit, id_produs, cantitate FROM intrari
) AS t
GROUP BY id_produs, id_depozit
HAVING id_produs = ? AND id_depozit = ?