CREATE TABLE IF NOT EXISTS clienti (
    id INTEGER NOT NULL REFERENCES utilizatori(id),
    adresa_livrare VARCHAR(256) NOT NULL,
    adresa_facturare VARCHAR(256) NOT NULL
);