START TRANSACTION;

-- north
INSERT INTO Zone (name, city, country) VALUES ('Copou', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Ticau', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Sararie', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Podu De Fier', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Agronomie', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Targu Cucu', 'Iasi', 'Romania');

-- east
INSERT INTO Zone (name, city, country) VALUES ('Tudor Vladimierscu', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Bucsinescu', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Tatarasi', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Moara De Vant', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Ciurchi', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Metalurgie', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Aviatiei', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Zona Industriala', 'Iasi', 'Romania');

-- south
INSERT INTO Zone (name, city, country) VALUES ('Baza Trei', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Bularga', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Bucium', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Socola', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Frumoasa', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Manta Rosie', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Podu Ros', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Dimitrie Cantemir', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Tesatura', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Nicolina Unu', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Nicolina Doi', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Cug Unu', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Cug Doi', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Galata Unu', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Galata Doi', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Podu De Piatra', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Zona Industriala Sud', 'Iasi', 'Romania');

-- west
INSERT INTO Zone (name, city, country) VALUES ('Mircea Cel Batran', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Alexandru Cel Bun', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Dacia', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Gara', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Pacurari', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Canta', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Pacuret', 'Iasi', 'Romania');
INSERT INTO Zone (name, city, country) VALUES ('Moara De Foc', 'Iasi', 'Romania');


INSERT INTO Tag (name, color) VALUES ('organic', 'green');
INSERT INTO Tag (name, color) VALUES ('paper', 'yellow');
INSERT INTO Tag (name, color) VALUES ('glass', 'orange');
INSERT INTO Tag (name, color) VALUES ('ceramic', 'orange');
INSERT INTO Tag (name, color) VALUES ('plastic', 'red');
INSERT INTO Tag (name, color) VALUES ('metal', 'blue');
INSERT INTO Tag (name, color) VALUES ('toxic', 'purple');

COMMIT;
