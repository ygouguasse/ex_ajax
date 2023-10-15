<?php
require 'controleur/Controleur.php';

try {
    if (!isset($_GET['action'])) {
        return AfficherPageAccueil();
    }
    switch ($_GET['action']) {
        case 'Accueil':
            AfficherPageAccueil();
            break;
        case 'Films':
            AfficherPageFilms();
            break;
        case 'ObtenirFilms':
            ObtenirFilms();
            break;
        default:
            throw new Exception('Aucune page spécifique demandée');
    }
} catch (PDOException $e) {
    $msgErreur = $e->getMessage();
    require 'vue/Erreur.php';
} catch (Exception $ex) {
    $msgErreur = $ex->getMessage();
    require 'vue/Erreur.php';
}