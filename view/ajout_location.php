<h2>Gestion des états des locations</h2>
<div id="formulaire">
<?php
    //formulaire qui permet de gérer les locations
    
    $form_location = new Zebra_Form('form_location');
    $form_location->language("francais");
    
    //champ caché qui contient l'id de l'investisseur
    $id = $form_location->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    //on va devoir travailler avec un datepicker
    $form_location->add('label','label_date_debut', 'date_debut', 'Date du début');
    $date_debut = $form_location->add('date', 'date_debut');
    $date_debut->set_rule(array(
        'required'      =>  array('error', 'Date is required!'),
        'date'          =>  array('error', 'Date is invalid!'),
    ));
    $date_debut->format('M d, Y');
    
    
    //on va devoir travailler avec un datepicker
    $form_location->add('label','label_date_fin', 'date_fin', 'Date de fin');
    $date_fin = $form_location->add('date', 'date_fin');
    $date_fin->set_rule(array(
        'required'      =>  array('error', 'Date is required!'),
        'date'          =>  array('error', 'Date is invalid!'),
    ));
    $date_fin->format('M d, Y');
    
    $form_location->add('label','label_loyer', 'loyer', 'Loyer');
    $num_tel = $form_location->add('text', 'loyer', null, array(
                                    'maxlength' => 20
                                ));
    
    $form_location->add('label','label_charges', 'charges', 'charges');
    $num_tel = $form_location->add('text', 'charges', null, array(
                                    'maxlength' => 20
                                ));
    
    //on va devoir récupérer les locataires présents dans la bd
    $form_location->add('label','label_locataire', 'select_locataire', 'Pour quel locataire ?');
    $locataire = $form_location->add('select', 'select_locataire');
    $locataire->add_options(array(
    
    ));
    
    //on va devoir récupérer les locataires présents dans la bd
    $form_location->add('label','label_chambre', 'select_locataire_chambre', 'Pour quelle chambre ?');
    $locataire_chambre = $form_location->add('select', 'select_locataire_chambre');
    $locataire->add_options(array(
    
    ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_location->add('submit', 'btnsubmit', 'Submit');
    
    $form_location->render('view/templates/tpl_location.php');

?>

</div>