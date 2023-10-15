<?php

require_once "modele/BD.php";

class ModeleFilm {
    public static function ObtenirTousLesFilms() {
        $sql = 'SELECT * FROM films';

        $requete = BD::ObtenirConnexion()->prepare($sql);
        $requete->execute();

        return $requete;
    }

    public static function ObtenirInfosFilmsParTitre($titre) {
        $sql = 'SELECT
                    films.*,
                    GROUP_CONCAT(genres.nom SEPARATOR ", ") as genres
                FROM films
                    INNER JOIN genres_films
                        ON genres_films.film = films.id
                    INNER JOIN genres
                        ON genres.id = genres_films.genre
                WHERE films.titre = :titre_film
                GROUP BY films.id';

        $requete = BD::ObtenirConnexion()->prepare($sql);
        $requete->bindparam('titre_film', $titre, pdo::PARAM_STR);
        $requete->execute();

        return $requete;
    }
}
?>