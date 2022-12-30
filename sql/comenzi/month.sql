SELECT id, beneficiar, data_comenzii, SUM(cantitate * pret_unitar) valoare
FROM (
    SELECT c.id, c.beneficiar, c.data_comenzii, NVL(lc.cantitate, 0) AS cantitate, NVL(lc.pret_unitar, 0) AS pret_unitar
    FROM comenzi c 
    LEFT JOIN 
    linie_produs_comanda lc 
    ON c.id = lc.id_comanda 
) AS linii
GROUP BY id, beneficiar, data_comenzii
HAVING data_comenzii >= DATE_SUB(NOW(), INTERVAL 1 MONTH); 