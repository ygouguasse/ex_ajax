<?php

require_once 'modele/ModeleFilm.php';
require_once 'modele/ModeleGenre.php';

function DecoderDonneesJSONRecues() {
	return json_decode(file_get_contents('php://input'), true);
}

function AfficherPageAccueil()
{
    require 'vue/Accueil.php';
}

function AfficherPageFilms()
{
	$films = ModeleFilm::ObtenirTousLesFilms();
	$genres = ModeleGenre::ObtenirTousLesGenres();

    require 'vue/Films.php';
}

function ObtenirFilms() {
	// On récupère les données qui ont été envoyé dans le body du fetch
	$_DONNEES = DecoderDonneesJSONRecues();
	
	if(empty($_DONNEES["titre"])) {
		// Bad request
		// Donc le reponse.ok dans le JavaScript sera false.
		// https://developer.mozilla.org/fr/docs/Web/HTTP/Status/400
		http_response_code(400);
		return;
	}
	
	$films = ModeleFilm::ObtenirInfosFilmsParTitre($_DONNEES["titre"]);

	if($films->rowCount() === 0) {
		// Not Found
		// Donc le reponse.ok dans le JavaScript sera false.
		// https://developer.mozilla.org/fr/docs/Web/HTTP/Status/404
		http_response_code(404);
		return;
	}

	// On indique qu'on envoie des données en JSON en utf-8
	header('Content-Type: application/json; charset=utf-8');

	// fetchAll récupère toutes les lignes et les envoies dans un tableau.
	// https://www.php.net/manual/fr/pdostatement.fetchall.php
	$reponse = $films->fetchAll();
	$films->closeCursor();

	// Les données qui seront obtenues avec reponse.json().
	// Notez que si vous faites d'autres echo ailleurs dans le code ou
	// que vous écrivez du HTML dans la réponse, reponse.json() ne sera
	// capable de décoder le JSON, car les données reçues ne seront pas du JSON.
	echo json_encode($reponse);
}