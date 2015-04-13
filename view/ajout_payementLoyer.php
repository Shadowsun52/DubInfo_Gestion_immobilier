<h2>Gestion des loyers</h2>
<div id="formulaire">
<?php
    //formulaire qui permet de gérer le payement des loyers
    //formulaire à mettre avec le formulaire "Location" ????
    
    $form_payement_loyer = new Zebra_Form('form_payement_loyer');
    $form_payement_loyer->language("francais");
    
    //champ cacher qui contient l'id du locataire
    
    $id = $form_payement_loyer->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_payement_loyer->add('label','label_sel_mois', 'select_mois', 'Sélectionnez le mois');
    $mois = $form_payement_loyer->add('select', 'select_mois');
    $mois->add_options(array(
    '1' => 'janvier',
    '2 '=> 'février',
    '3' => 'mars',
    '4' => 'avril',
    '5' => 'mai',
    '6' => 'juin',
    '7' => 'juillet',
    '8' => 'août',
    '9' => 'septembre',
    '10' => 'octobre',
    '11' => 'novembre',
    '12' => 'décembre'
    ));
    
    $form_payement_loyer->add('label','label_sel_annee', 'select_annee', 'Sélectionnez l\'année');
    $annee = $form_payement_loyer->add('select', 'select_annee');
    $annee->add_options(array(
    '1' => (date('Y')-2),
    '2 '=> (date('Y')-1),
    '3' => date('Y'),
    '4' => date('Y')+1
    ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    
    $form_payement_loyer->add('submit', 'btnsubmit', 'Submit');
    
    $form_payement_loyer->render();

?>

</div>