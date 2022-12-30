SELECT 'O ora' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 1 HOUR)
UNION 
SELECT 'Doua ore' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 2 HOUR)
UNION 
SELECT '4 ore' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 4 HOUR)
UNION 
SELECT '8 ore' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 8 HOUR)
UNION 
SELECT '24 ore' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 1 DAY)
UNION 
SELECT '7 zile' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 7 DAY)
UNION 
SELECT 'O luna' AS timp, COUNT(DISTINCT ip) AS ip
FROM accesari 
WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
