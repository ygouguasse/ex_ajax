CREATE DATABASE IF NOT EXISTS `bd_film` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bd_film`;

DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nom` nvarchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `films`;
CREATE TABLE `films` (
    `id` int NOT NULL AUTO_INCREMENT,
    `titre` nvarchar(255) NOT NULL,
    `realisateur` nvarchar(255) NOT NULL,
    `annee_sortie` int NOT NULL,
    `duree_minutes` int NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

DROP TABLE IF EXISTS `genres_films`;
CREATE TABLE `genres_films` (
    `id` int NOT NULL AUTO_INCREMENT,
    `film` int NOT NULL,
    `genre` int NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (film) REFERENCES films(id),
    FOREIGN KEY (genre) REFERENCES genres(id)
) ENGINE=InnoDB;

INSERT INTO `genres` (`nom`) VALUES
('Drame'),
('Crime'),
('Action'),
('Comédie'),
('Aventure'),
('Science-Fiction'),
('Romance'),
('Horreur'),
('Fantaisie'),
('Thriller'),
('Biographie'),
('Histoire');

INSERT INTO `films` (`titre`, `realisateur`, `annee_sortie`, `duree_minutes`) VALUES
("The Shawshank Redemption", "Frank Darabont", 1994, 142),
("The Godfather", "Francis Ford Coppola", 1972, 175),
("Pulp Fiction", "Quentin Tarantino", 1994, 154),
("The Dark Knight", "Christopher Nolan", 2008, 152),
("Forrest Gump", "Robert Zemeckis", 1994, 142),
("Inception", "Christopher Nolan", 2010, 148),
("The Matrix", "Wachowski Siblings", 1999, 136),
("The Lord of the Rings: The Fellowship of the Ring", "Peter Jackson", 2001, 178),
("The Social Network", "David Fincher", 2010, 120),
("Jurassic Park", "Steven Spielberg", 1993, 127),
("Avatar", "James Cameron", 2009, 162),
("The Silence of the Lambs", "Jonathan Demme", 1991, 118),
("Gladiator", "Ridley Scott", 2000, 155),
("Eternal Sunshine of the Spotless Mind", "Michel Gondry", 2004, 108),
("Schindler's List", "Steven Spielberg", 1993, 195),
("Fight Club", "David Fincher", 1999, 139),
("The Departed", "Martin Scorsese", 2006, 151),
("The Revenant", "Alejandro González Iñárritu", 2015, 156),
("The Grand Budapest Hotel", "Wes Anderson", 2014, 99),
("Black Panther", "Ryan Coogler", 2018, 134);

INSERT INTO `genres_films` (`film`, `genre`) VALUES
(1, 1), (2, 1), (3, 1), (5, 1), (9, 1), (12, 1), (13, 1), (14, 1), (15, 1), (16, 1), (17, 1), (18, 1),
(2, 2), (3, 2), (4, 2), (12, 2), (17, 2),
(4, 3), (6, 3), (7, 3), (11, 3), (13, 3), (20, 3),
(19, 4),
(8, 5), (10, 5), (11, 5), (13, 5), (18, 5), (19, 5), (20, 5),
(6, 6), (7, 6), (10, 6), (14, 6), (20, 6),
(5, 7), (14, 7),
(12, 8),
(8, 9),
(17, 10),
(15, 11),
(15, 12);
