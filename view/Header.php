<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/styles.css">
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="librairies/multiple_select/jquery.multiple.select.js"></script>
    <link rel="stylesheet" href="librairies/multiple_select/multiple-select.css">

    <!-- Ajout du CSS et du jQuery pour le menu -->

    <link rel="stylesheet" type="text/css" href="CSS/sm-blue.css">
    <link rel="stylesheet" type="text/css" href="CSS/sm-core-css.css">
    <script src="js/jquery.smartmenus.js"></script>
    <script>

        $(document).ready(function($) {
             $('#main-menu').smartmenus();
        });
        </script>

    <!-- Fin de la partie "Menu" -->

    <?php
    require './view/connexion.php';
    if(!isset($_SESSION['login_crm'])) {
    ?>
        <link rel="stylesheet" href="librairies/Zebra_Form-2.9.5/public/css/zebra_form.css">
        <script src="librairies/Zebra_Form-2.9.5/public/javascript/zebra_form.js"></script>
    <?php
    }
    else {
        if(isset($_GET['action'])) {
            if($_GET['action'] === 'gestion') {
                ?>
                <link rel="stylesheet" href="librairies/Zebra_Form-2.9.5/public/css/zebra_form.css">
                <script src="librairies/Zebra_Form-2.9.5/public/javascript/zebra_form.js"></script>
                <script src="js/crud_ajax.js"></script>
                <script src="js/adresse_list.js"></script>
                <script src="js/visite.js"></script>
                <?php
            }
            elseif ($_GET['action'] === 'liste') {
                ?>
                <link rel="stylesheet" href="librairies/Zebra_date_picker/public/css/default.css">
                <script src="./librairies/list_js/list.js"></script>
                <script src="librairies/Zebra_date_picker/public/javascript/zebra_datepicker.js"></script>
                <?php
            }
        }
    }
    ?>
    <title>CRM Bestinvestment</title>
</head>
<body>
    <header>
        <!-- Ajout du logo, modification du menu et insertion du module SmartMenus -->

        <div class="logo"><img src="images/logo.png" alt=""> </div>
        <h1>CRM</h1>
    <?php
        if(isset($_SESSION['login_crm'])) {
    ?>
        <form id="form_deco" method="post">
            <label>Vous êtes connecté en tant que <?php echo $_SESSION['login_crm'] ?> </label>
            <input type="hidden" name="deconnexion" value="true"/>
            <input id="bnt_deco" type="submit" value="Déconnexion"/>
        </form>
    <?php
        }
    ?>
        <nav class="menuIntranet">
            <ul id="main-menu"class="sm sm-blue ">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=gestion&item=maison">Maison</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=sourceMaison">Source des maisons</a></li>
                        <li><a href="index.php?action=gestion&item=contact">Contacts</a></li>
                        <li><a href="index.php?action=gestion&item=prospectionMaison">Prospections de maison</a></li>
                        <li class="separator_list"><a href="index.php?action=liste&item=maison">Liste des maisons</a></li>
                        <li><a href="index.php?action=liste&item=chambre">Liste des chambres</a></li>
                    </ul>
                </li>
                <li><a href="index.php?action=gestion&item=investisseur">Investisseurs</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=rencontreInvestisseur">Rencontres avec les investisseurs</a></li>
                        <li><a href="index.php?action=gestion&item=visiteMaisonInvestisseur">Visites de maisons par un investisseur</a></li>
                        <li><a href="index.php?action=gestion&item=projet">Projets</a></li>    
                        <li class="separator_list"><a href="index.php?action=liste&item=investisseur">Liste des investisseurs</a></li>
                        <li><a href="index.php?action=liste&item=rencontreInvestisseur">Liste des rencontres avec les investisseurs</a></li>
                        <li><a href="index.php?action=liste&item=visiteMaisonInvestisseur">liste des visites de maisons</a></li>
                        <li><a href="index.php?action=liste&item=projet">Liste des projets</a></li>   
                    </ul>
                </li>
                <li><a href="index.php?action=gestion&item=locataire">Locataires</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=sourceLocataire">Source des locataires</a></li>
                        <li><a href="index.php?action=gestion&item=visiteLocataire">Visites pour les locataires</a></li>
                        <li class="separator_list"><a href="index.php?action=liste&item=locataire">Liste des locataires</a></li>
                    </ul>
                </li>
                <li><a href="index.php?action=gestion&item=location">Locations</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=paiementLoyer">Paiements des loyers</a></li>
                        <li class="separator_list"><a href="index.php?action=liste&item=location">Liste des locations</a></li>
                        <li><a href="index.php?action=liste&item=paiementLoyer">Liste des paiements de loyer</a></li>
                    </ul>   
                </li>
                <li><a href="index.php?action=gestion&item=professionnel">Professionnels</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=metier">Métiers</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="clear"></div>
    </header>