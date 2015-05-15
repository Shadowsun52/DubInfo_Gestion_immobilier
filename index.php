<?php
    namespace DubInfo_gestion_immobilier;
    require './init.php';
    require './view/Header.php';
?>
    <div id="center">
<?php
    //on regarde si le visiteur est connecté
    if(isset($_SESSION['login_crm'])) {
        //on regarde si on a cliqué sur une action
        if(isset($_GET['action']) && isset($_GET['item']))
        {
            //on vérifie que la view existe
            if(file_exists('./view/' . $_GET['action'] . '_' . $_GET['item'] . '.php'))
            {
                require './view/' . $_GET['action'] . '_' . $_GET['item'] . '.php';
            }
            else
            {
                include './view/error404.php';
            } 
        }
        else
        {
            echo '<p>accueil</p>';
        }
    }
    //sinon on affiche la page de connexion
    else {
        require './view/form_connexion.php';
    }
?>
    </div>
<?php
    require './view/Footer.php';
?>