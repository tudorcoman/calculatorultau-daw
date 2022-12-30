CREATE TABLE IF NOT EXISTS comenzi (
    id INTEGER AUTO_INCREMENT PRIMARY KEY, 
    beneficiar INTEGER NOT NULL REFERENCES utilizatori(id), 
    adresa_livrare VARCHAR(256) NOT NULL,
    cod_promotie VARCHAR(16),
    data_comenzii DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS linie_produs_comanda (
    id_comanda INTEGER NOT NULL REFERENCES comenzi(id),
    id_produs INTEGER NOT NULL REFERENCES produse(id),
    id_depozit INTEGER NOT NULL REFERENCES depozit(id),
    cantitate INTEGER NOT NULL,
    pret_unitar FLOAT NOT NULL,
    PRIMARY KEY (id_comanda, id_produs)
);