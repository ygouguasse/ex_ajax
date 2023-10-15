<?php $titre = 'Informations sur un film'; ?>

<?php ob_start(); ?>

<div id="conteneur_alerte"></div>

<div class="row g-2">
    <div class="col-sm-8 col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="titre" placeholder="Titre" list="titres">
            <label for="titre">Film</label>
            <datalist id="titres">
            <?php
                while ($film = $films->fetch()) {
                    echo    '<option value="'.$film['titre'].'">'.
                                $genre['titre'] .
                            '</option>';
                }
                $films->closeCursor();
            ?>
            </datalist>
        </div>
    </div>

    <div class="col-sm-4 col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="genre" placeholder="Genre" list="genres">
            <label for="genre">Genre</label>
            <datalist id="genres">
            <?php
                while ($genre = $genres->fetch()) {
                    echo    '<option value="'.$genre['nom'].'">'.
                                $genre['nom'] .
                            '</option>';
                }
                $genres->closeCursor();
            ?>
            </datalist>
        </div>
    </div>
</div>

<table id="TableInfosFilm" class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Réalisateur</th>
            <th scope="col">Durée (min.)</th>
            <th scope="col">Date sortie</th>
            <th scope="col">Genres</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<script type="module" src="js/films.js"></script>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/Gabarit.php'; ?>