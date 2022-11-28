CREATE TABLE IF NOT EXISTS produse (
   id INTEGER AUTO_INCREMENT PRIMARY KEY,
   nume VARCHAR(300) UNIQUE NOT NULL,
   descriere TEXT,
   pret NUMERIC(8,2) NOT NULL,
   pret_redus NUMERIC(8, 2),
   greutate INT NOT NULL CHECK (greutate>=0),
   an_fabricatie INT NOT NULL,   
   tip_produs ENUM('procesor', 'placi de baza', 'memorie', 'stocare', 'placi video', 'carcase', 'surse de alimentare', 'monitoare', 'tastaturi', 'mouse', 'cabluri', 'altele') DEFAULT 'altele',
   categorie ENUM( 'componente', 'conectica', 'periferice', 'accesorii') DEFAULT 'componente',
   culoare VARCHAR(50) NOT NULL,
   materiale VARCHAR(120),
   resigilat BOOLEAN NOT NULL DEFAULT FALSE,
   imagine VARCHAR(300),
   data_adaugare TIMESTAMP DEFAULT current_timestamp
);

INSERT INTO produse (nume, descriere, pret, greutate, an_fabricatie, tip_produs, categorie, culoare, materiale, resigilat, imagine) VALUES
('Procesor Intel Rocket Lake, Core i9 11900KF 3.5GHz box', 'Procesoarele din seria Intel® Core™ generatia 11 sunt compatibile doar cu placile de baza cu chipset H510/B560/H570/Z590/Z490/H470(In anumite cazuri este necesar update de BIOS. Verificati pagina producatorului placii de baza pentru mai multe informatii).', 2499.99, 500, 2021, 'procesor', 'componente', 'argintiu', '["aluminiu", "plastic"]', False, '/assets/img/produse/rocket-lake-core-i9-11900kf-35ghz-box-218b3e4ebafdb8504cdea0e6f38a3200.jpg'),
('Placa video Gainward GeForce RTX 3080 Ti Phoenix LHR 12GB GDDR6X 384-bit', 'Tehnologii: Microsoft DirectX® 12 Ultimate, NVIDIA DLSS, PCI Express Gen 4, NVIDIA® GeForce Experience™, NVIDIA Ansel, NVIDIA FreeStyle, NVIDIA ShadowPlay, NVIDIA Highlights, NVIDIA GPU Boost™, HDMI 2.1, DisplayPort 1.4a, 2nd Generation RT Cores, 3rd Generation Tensor Cores', 8799.99, 1000, 2021, 'placi video', 'componente', 'argintiu', '["plastic", "cupru"]', False, '/assets/img/produse/geforce-rtx-3080-ti-phoenix-12gb-gddr6x-384-bit-3a3cd6f577d666c65b271d8b0eb96d3a.png'),
('Memorie Corsair Vengeance RGB PRO SL 32GB DDR4 3200MHz CL16 Dual Channel Kit', 'Seria Vengeance RGB PRO SL, recomandata pentru Gaming', 799.99, 450, 2020, 'memorie', 'componente', 'negru', '["metal", "plastic"]', False, '/assets/img/produse/vengeance-rgb-pro-sl-16gb-ddr4-3600mhz-cl18-dual-channel-kit-9fa9eab4bf71d945704686079d4abc28.jpg'),
('Placa de baza ASUS PRIME Z690M-PLUS D4', 'Chipset Z690, format mATX, pentru procesoare Intel 12th Generation Core/Pentium Gold/Celeron', 1249.99, 1250, 2020, 'placi de baza', 'componente', 'negru', '["metal"]', False, '/assets/img/produse/prime-z690m-plus-d4-37d8f1169425f6314cf8b0cb57799a4d.jpg');

INSERT INTO produse (nume, descriere, pret, greutate, an_fabricatie, tip_produs, categorie, culoare, materiale, resigilat, imagine) VALUES
('SSD Transcend 370 Premium Series 256GB SATA-III 2.5 inch', 'Citire 560 MB/s, Scriere 320 MB/s, adaptor inclus pentru 3.5 inch', 599.99, 52, 2022, 'stocare', 'componente', 'gri', '["metal", "plastic"]', False, '/assets/img/produse/370s-premium-series-32gb-sata-iii-25-inch-5eba90bd18ca8e28502d2686f93dd629.jpg'),
('Monitor LED DELL UltraSharp U2421E 24.1 inch 8 ms Negru USB-C 60 Hz', 'Monitor mare pentru cresterea productivitatii', 1799.99, 5000, 2022, 'monitoare', 'periferice', 'negru', '["metal", "plastic"]', False, '/assets/img/produse/ultrasharp-u2421e-241-inch-8-ms-negru-usb-c-60-hz-e334b61a9594e88948f3fc531f0cf1ba.jpg'),
('Tastatura Gaming Logitech G213 Prodigy Gaming', 'Tastatura de 4x mai rapida decat tastaturile standard, recomandata pentru Gaming', 199.99, 650, 2020, 'tastaturi', 'periferice', 'negru', '["plastic"]', False, '/assets/img/produse/g213-prodigy-gaming-db1b99b627fb7e703743950e1d48660b.jpg'),
('Sursa Corsair CV550, 80+ Bronze, 550W', 'Sursa de alimentare de calitate 80+ Bronze, silentioasa', 299.99, 1450, 2021, 'surse de alimentare', 'componente', 'negru', '["metal"]', False, '/assets/img/produse/cv550-80-plus-bronze-550w-bff048a0c1bdf65221c2fd14f37a07e4.jpg'),
('Mouse Logitech MX Master 3 Graphite', 'Mouse versatil, 4000 dpi, permite lucrarea pe 3 calculatoare in acelasi timp', 599.99, 141, 2021, 'mouse', 'periferice', 'negru', '["plastic"]', False, '/assets/img/produse/mx-master-3-graphite-856ca0a3911f0f3477f81a07293b8259.jpg'),
('Carcasa Fractal Design Define 7 XL Black TG Light Tint', 'Carcasa cu panou de sticla', 1299.99, 16640, 2021, 'carcase', 'componente', 'negru', '["metal", "sticla"]', False, '/assets/img/produse/define-7-xl-black-tg-light-tint-ab806b206d024141206c6a3a6cac840f.jpg');

