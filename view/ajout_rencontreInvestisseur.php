<h2>Gestion des rencontres avec les investisseurs</h2>
<div id="formulaire">

<?php
    //formulaire qui permet de gérer les rencontres avec les investisseurs
    
    $form_rencontre_investisseur = new Zebra_Form('form_rencontre_investisseur');
    $form_rencontre_investisseur->language("francais");
    
    //champ cacher qui contient l'id de la lettre de mission
    //si vide, ajout, autrement modification
    $id = $form_rencontre_investisseur->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_rencontre_investisseur->add('label','label_endroit', 'endroit', 'Endroit');
    $nom = $form_rencontre_investisseur->add('text', 'endroit', null, array(
                                    'maxlength' => 45
                                ));
    
    //datepicker
    $form_rencontre_investisseur->add('label','label_date_rencontre', 'date_rencontre', 'Date de la recontre');
    $date = $form_rencontre_investisseur->add('date', 'date_rencontre');
    $date->set_rule(array(
        'required'      =>  array('error', 'Date is required!'),
        'date'          =>  array('error', 'Date is invalid!'),
    ));

    // date format
    // don't forget to use $date->get_date() if the form is valid to get the date in YYYY-MM-DD format ready to be used
    // in a database or with PHP's strtotime function!
    $date->format('M d, Y');
        
    //rapport
    $form_rencontre_investisseur->add('label','label_rapport', 'rapport', 'Rapport');
    $remarque = $form_rencontre_investisseur->add('text', 'rapport', null, array(
                                    'maxlength' => 100
                                ));
    //quel investisseur ?
    $investisseur = $form_rencontre_investisseur->add('select', 'select_etat');
    $investisseur->add_options(array(
    
    ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_rencontre_investisseur->add('submit', 'btnsubmit', 'Submit');
    
    $form_rencontre_investisseur->render();

?>
</div>