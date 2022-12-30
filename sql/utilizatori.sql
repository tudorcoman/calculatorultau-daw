CREATE TABLE IF NOT EXISTS utilizatori (
   id INTEGER AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(50) UNIQUE NOT NULL,
   nume VARCHAR(100) NOT NULL,
   prenume VARCHAR(100) NOT NULL,
   parola VARCHAR(500) NOT NULL,
   rol ENUM('admin', 'comun') NOT NULL DEFAULT 'comun',
   email VARCHAR(100) NOT NULL,
   culoare_chat VARCHAR(50) NOT NULL,
   data_adaugare TIMESTAMP DEFAULT current_timestamp,
   cod VARCHAR(200),
   confirmat_mail boolean DEFAULT false
);

CREATE TABLE IF NOT EXISTS accesari (
   id INTEGER AUTO_INCREMENT PRIMARY KEY,
   ip VARCHAR(100) NOT NULL,
   user_id INT NOT NULL REFERENCES utilizatori(id),
   pagina VARCHAR(500) NOT NULL,
   data_accesare TIMESTAMP DEFAULT current_timestamp
);


