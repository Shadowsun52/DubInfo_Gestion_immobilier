<h2>Gestion des projets</h2>
<div id="formulaire">
<?php
    //formulaire qui permet d'ajouter un projet
    
    $form_projet = new Zebra_Form('form_projet');
    $form_projet->language("francais");
    
    //champ caché qui contient l'id de l'investisseur
    $id = $form_projet->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    //on va devoir travailler avec un datepicker
    $form_projet->add('label','label_date_signature_compromis', 'date_signature_compromis', 'Date de la signature du compromis');
    $nom = $form_projet->add('text', 'date_signature_compromis', null, array(
                                    'maxlength' => 45
                                ));
    
    //on va devoir travailler avec un datepicker
    $form_projet->add('label','label_date_signature_acte', 'date_signature_acte', 'Date de la signature à l\'acte');
    $nom = $form_projet->add('text', 'date_signature_acte', null, array(
                                    'maxlength' => 45
                                ));
    
    $form_projet->add('label','label_plan_metre_fait', 'plan_metre_fait', 'Plan mètre fait');
    $num_tel = $form_projet->add('text', 'plan_metre_fait', null, array(
                                    'maxlength' => 20
                                ));
    //boutons radios non (par défaut) et oui
    $form_projet->add('label','label_devis_entrepreneur_confirme', 'devis_entrepreneur_confirme', 'Devis de l\'entrepreneur confirmé ?');
    $num_gsm = $form_projet->add('radios', 'devis_entrepreneur_confirme', array(
                                    '0'=>'non',
                                    '1'=>'oui'
                                ));
    
    //boutons radios non (par défaut) et oui
    $form_projet->add('label','label_selection_metaux_fait', 'selection_metaux_fait', 'Sélection des métaux fait ?');
    $selection_metaux = $form_projet->add('radios', 'selection_metaux_fait', array(
                                    '0'=>'non',
                                    '1'=>'oui'
                                ));
    
    //on va devoir travailler avec un datepicker
    $form_projet->add('label','label_date_reception_chantier', 'date_reception_chantier', 'Date de la réception du chantier');
    $nom = $form_projet->add('text', 'date_reception_chantier', null, array(
                                    'maxlength' => 45
                                ));
    
    //boutons radios non (par défaut) et oui
    $form_projet->add('label','label_commande_mobilier_fait', 'commande_mobilier_fait', 'Commande du mobilier fait ?');
    $commande_mobilier_fait = $form_projet->add('radios', 'commande_mobilier_fait', array(
                                    '0'=>'non',
                                    '1'=>'oui'
                                ));
    
    //on va devoir travailler avec un datepicker => date livraison mobilier
    $form_projet->add('label','label_date_livraison_mobilier', 'date_livraison_mobilier', 'Date de la livraison du mobilier');
    $nom = $form_projet->add('text', 'date_livraison_mobilier', null, array(
                                    'maxlength' => 45
                                ));
    
    $etat = $form_projet->add('select', 'select_etat');
    $etat->add_options(array(
    //ceci ne fonctionne pas (choisissez un etat)    
    ''  => '- Choisissez un etat -',
    '1' => 'Potentiel',
    '2 '=> 'Actif',
    '3' => 'Abandonné'
    ));
    
    //remarque
    $form_projet->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_projet->add('textarea', 'remarque', null, array(
                                    'maxlength' => 100
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_projet->add('submit', 'btnsubmit', 'Submit');
    
    $form_projet->render('view/templates/tpl_projet.php');

?>
</div>