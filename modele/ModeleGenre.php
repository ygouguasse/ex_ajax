<?php

require_once "modele/BD.php";

class ModeleGenre {
    public static function ObtenirTousLesGenres() {
        $sql = 'SELECT * FROM genres';

        $requete = BD::ObtenirConnexion()->prepare($sql);
        $requete->execute();

        return $requete;
    }
}
?>