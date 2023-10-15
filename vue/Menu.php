<nav class="navbar navbar-expand-sm bg-primary navbar-dark w-100 rounded-bottom">
    <ul class="navbar-nav px-3 w-100">
        <li class="nav-item">
            <a  class="nav-link <?php ParDefaut(); NavClass("Accueil"); ?>"
                href="index.php?action=Accueil">
                Accueil
            </a>
        </li>
        <li class="nav-item">
            <a  class="nav-link <?php NavClass("Films"); ?>"
                href="index.php?action=Films">
                Films
            </a>
        </li>
    </ul>
</nav>

<?php
function ParDefaut() {
    if (!isset($_GET["action"])) {
        echo "active";
    }
}

function NavClass($menu) {
    if (isset($_GET["action"]) &&
        $_GET["action"] === $menu) {
        echo ' active ';
    }
}

function AfficherBoutonConnexion() {
    if (empty($_SESSION['utilisateur']) || !$_SESSION['utilisateur']['connecte']) {
        ?>
        <li class="nav-item ms-auto">
            <a  class="nav-link <?php NavClass("Connexion"); ?>"
                href="index.php?action=Connexion">
                Connexion
            </a>
        </li>
        <?php
    }
}

function AfficherBoutonDeconnexion() {
    if (!empty($_SESSION['utilisateur']) && $_SESSION['utilisateur']['connecte']) {
        ?>
        <li class="nav-item ms-auto">
            <a  class="nav-link"
                href="index.php?action=Deconnecter">
                Déconnexion
            </a>
        </li>
        <?php
    }
}

function AfficherBoutonInscription() {
    if (empty($_SESSION['utilisateur']) || !$_SESSION['utilisateur']['connecte']) {
        ?>
        <li class="nav-item">
            <a  class="nav-link <?php NavClass("Inscription"); ?>"
                href="index.php?action=Inscription">
                Inscription
            </a>
        </li>
        <?php
    }
}
?>
