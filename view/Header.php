<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Erreur ici, ne pas mettre de ../ -->
        <link rel="stylesheet" href="librairies/Zebra_Form-2.9.5/public/css/zebra_form.css">
        <link rel="stylesheet" href="librairies/Zebra_date_picker/public/css/default.css">
        <link rel="stylesheet" href="CSS/styles.css">
        <script src="js/jquery-2.1.3.min.js"></script>
        <script src="librairies/Zebra_Form-2.9.5/public/javascript/zebra_form.js"></script>
        <script src="librairies/multiple_select/jquery.multiple.select.js"></script>
        <link rel="stylesheet" href="librairies/multiple_select/multiple-select.css">
<?php
    if(isset($_GET['action'])) {
?>
        <script src="js/crud_ajax.js"></script>
        <script src="js/adresse_list.js"></script>
<?php
    }
?>
        <title>CRM Bestinvestment</title>
    </head>
    <body>
        <header>
            <h1>Intranet</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?action=gestion&item=investisseur">Gestion des investisseurs</a></li>
                    <li><a href="index.php?action=gestion&item=locataire">Gestion des locataires</a></li>
                    <li><a href="index.php?action=gestion&item=sourceLocataire">Gestion des source des locataires</a></li>
                    <li><a href="index.php?action=gestion&item=maison">Gestion des maison</a></li>
                    <li><a href="index.php?action=gestion&item=sourceMaisons">Gestion des source des maisons</a></li>
                    <li><a href="index.php?action=ajout&item=projet">Gestion des projets</a></li>                  
                    <li><a href="index.php?action=ajout&item=location">Gestion des Locations</a></li>
                    <li><a href="index.php?action=ajout&item=lettreMission">Gestion des lettres de mission</a></li>
                    <li><a href="index.php?action=ajout&item=payementLoyer">Gestion des payments des loyers</a></li>
                    <li><a href="index.php?action=ajout&item=rencontreInvestisseur">Gestion des rencontres avec les investisseurs</a></li>
                    <li><a href="index.php?action=gestion&item=professionnel">Gestion des professionnels</a></li>
                    <li><a href="index.php?action=gestion&item=metier">Gestion des métiers</a></li>
                    
                </ul>
            </nav>
        </header>