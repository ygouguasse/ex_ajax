<?php $titre = 'Accueil'; ?>

<?php ob_start(); ?>

<h3>Page d'accueil</h3>

<?php $contenu = ob_get_clean(); ?>

<?php require 'vue/Gabarit.php'; ?>