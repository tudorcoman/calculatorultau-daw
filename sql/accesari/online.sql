SELECT username 
FROM utilizatori
WHERE id in (
    SELECT DISTINCT(user_id) 
    FROM accesari 
    WHERE data_accesare >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)
);

