
CREATE TABLE IF NOT EXISTS tranzactii_produse (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    timp TIMESTAMP DEFAULT current_timestamp,
    id_produs INTEGER NOT NULL REFERENCES produse(id),
    id_depozit_intrare INTEGER NOT NULL REFERENCES depozite(id),
    id_depozit_iesire INTEGER NOT NULL REFERENCES depozite(id),
    cantitate INTEGER NOT NULL
);

CREATE TABLE IF NOT EXISTS intrari (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    timp TIMESTAMP DEFAULT current_timestamp,
    id_produs INTEGER NOT NULL REFERENCES produse(id),
    id_depozit INTEGER NOT NULL REFERENCES depozite(id),
    cantitate INTEGER NOT NULL
);

INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (1, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (2, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (3, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (4, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (5, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (6, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (7, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (8, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (9, 2, 1000);
INSERT INTO intrari (id_produs, id_depozit, cantitate) VALUES (10, 2, 1000);

INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (1, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (2, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (3, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (4, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (5, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (6, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (7, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (8, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (9, 1, 2, 100);
INSERT INTO tranzactii_produse (id_produs, id_depozit_intrare, id_depozit_iesire, cantitate) VALUES (10, 1, 2, 100);