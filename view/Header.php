<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="librairies/Zebra_Form-2.9.5/public/css/zebra_form.css">
    <link rel="stylesheet" href="librairies/Zebra_date_picker/public/css/default.css">
    <link rel="stylesheet" href="CSS/styles.css">
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="librairies/Zebra_Form-2.9.5/public/javascript/zebra_form.js"></script>
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
    if(isset($_GET['action'])) {
        if($_GET['action'] === 'gestion') {
            ?>
            <script src="js/crud_ajax.js"></script>
            <script src="js/adresse_list.js"></script>
            <script src="js/visite.js"></script>
            <?php
        }
        elseif ($_GET['action'] === 'liste') {
            ?>
            <script src="http://listjs.com/no-cdn/list.js"></script>
            <?php
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
        <nav class="menuIntranet">
            <ul id="main-menu"class="sm sm-blue ">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=gestion&item=maison">Maison</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=sourceMaison">Source des maisons</a></li>
                        <li><a href="index.php?action=gestion&item=contact">Contacts</a></li>
                        <li><a href="index.php?action=gestion&item=prospectionMaison">Prospections de maison</a></li>
                    </ul>
                </li>
                <li><a href="index.php?action=gestion&item=investisseur">Investisseurs</a>
                    <ul>
                        <li><a href="index.php?action=gestion&item=rencontreInvestisseur">Rencontres avec les investisseurs</a></li>
                        <li><a href="index.php?action=gestion&item=visiteMaisonInvestisseur">Visites de maisons par un investisseur</a></li>
                        <li><a href="index.php?action=gestion&item=projet">Projets</a></li>    
                        <li class="separator_list"><a href="index.php?action=liste&item=investisseur">Liste des investisseurs</a></li>
                        <li><a href="index.php?action=liste&item=rencontreInvestisseur">Liste des rencontres avec les investisseurs</a></li>
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