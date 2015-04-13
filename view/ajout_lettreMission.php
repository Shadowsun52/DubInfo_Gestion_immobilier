<h2>Gestion des lettres de mission</h2>
<div id="formulaire">
<?php
    //formulaire qui permet de gérer les lettres de mission (par rapport aux investisseurs)
    
    $form_lettre_mission = new Zebra_Form('form_lettre_mission');
    $form_lettre_mission->language("francais");
    
    //champ cacher qui contient l'id de la lettre de mission
    //si vide, ajout, autrement modification
    $id = $form_lettre_mission->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_lettre_mission->add('label','label_budget', 'budget', 'Budget');
    $nom = $form_lettre_mission->add('text', 'budget', null, array(
                                    'maxlength' => 45
                                ));
    
    //datepicker
    $form_lettre_mission->add('label','label_delai', 'delai', 'Délai');
    $date_lettre_mission = $form_lettre_mission->add('date', 'delai', null, array(
                                    'maxlength' => 45
                                ));
    
    //boutons radios non (par défaut) et oui
    $form_lettre_mission->add('label','label_signature_ok', 'signature_ok', 'Signature OK ?');
    $signature = $form_lettre_mission->add('radios', 'signature_ok', array(
                                    '0'=>'non',
                                    '1'=>'oui'
                                ));
    
    //quel investisseur ?
    $form_lettre_mission->add('label','label_sel_etat', 'select_etat', 'Sélectionnez l\'étât de l\'investisseur');
    $investisseur = $form_lettre_mission->add('select', 'select_etat');
    $investisseur->add_options(array(
    
    ));
    
    //remarque
    $form_lettre_mission->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_lettre_mission->add('textarea', 'remarque', null, array(
                                    'maxlength' => 100
                                ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_lettre_mission->add('submit', 'btnsubmit', 'Submit');
    
    
    
    $form_lettre_mission->render('view/templates/tpl_lettre_mission.php');

?>
</div>