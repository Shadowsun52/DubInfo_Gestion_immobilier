<div id="formulaire">
<?php
    
    //formulaire qui permet de gérer les maisons
    
    $form_maison = new Zebra_Form('form_maison');
    $form_maison->language("francais");
    
    //champ cacher qui contient l'id de l'investisseur
    $id = $form_maison->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    $form_maison->add('label','label_titre', 'titre', 'Titre');
    $titre = $form_maison->add('text', 'titre', null, array(
                                    'maxlength' => 45
                                ));
    $titre->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_maison->add('label','label_rue', 'rue', 'Rue');
    $num_gsm = $form_maison->add('text', 'rue', null, array(
                                    'maxlength' => 80
                                ));
    $form_maison->add('label','label_numero', 'numero', 'N°');
    $num_gsm = $form_maison->add('text', 'numero', null, array(
                                    'maxlength' => 10
                                ));
    
    $form_maison->add('label','label_boite', 'boite', 'Boîte');
    $num_gsm = $form_maison->add('text', 'boite', null, array(
                                    'maxlength' => 10
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $pays = $form_maison->add('select', 'select_pays');
    $pays->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    ''  => 'Choisissez un pays',
    '1' => 'Belgique',
    '2 '=> 'France',
    '3' => 'Luxembourg',
    'Autre' => 'Autre'
    ));
    
    //ld avec les CP
    $cp = $form_maison->add('select', 'select_cp');
    
    //ld avec les villes
    $villes = $form_maison->add('select', 'select_villes');
    
    $form_maison->add('label','label_etat', 'select_etat', 'Etat');
    $etat = $form_maison->add('select', 'select_etat');
    $etat->add_options(array(
        '1' => 'Potentiel',
        '2'=> 'Actif',
        '3' => 'Abandonné'
    ),true);
    
    //input caché pour l'abandon (à modifier)
    $raison_abandon = $form_maison->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    
    //input caché pour l'id de la source (à modifier)
    $id = $form_maison->add('hidden', 'id', null, array(
                                    'maxlength' => 5
                                ));
    //label de la source
    $form_maison->add('label','label_source', 'select_source', 'Source');
    //select de la source
    $source = $form_maison->add('select', 'select_source');
    $source->add_options(array(
        '1' => 'Potentiel',
        '2'=> 'Actif',
        '3' => 'Abandonné'
    ),true);
    
    
    //label et text du prix
    $form_maison->add('label','label_prix', 'prix', 'Prix');
    $num_gsm = $form_maison->add('text', 'prix', null, array(
                                    'maxlength' => 50
                                ));
    //label et text de la superficie
    $form_maison->add('label','label_superficie_habitalble', 'superficie_habitalble', 'Superficie habitalble en m carré');
    $num_gsm = $form_maison->add('text', 'superficie_habitalble', null, array(
                                    'maxlength' => 50
                                ));
    
    //label et text de l'état
    $etat = $form_maison->add('select', 'select_etat');
    $etat->add_options(array(
    //ceci ne fonctionne pas (choisissez un etat)    
    ''  => '- Choisissez un etat -',
    '1' => 'Potentiel',
    '2 '=> 'Actif',
    '3' => 'Abandonné'
    ));
    
    //salle de bain (sdb)
    $sdb = $form_maison->add('select', 'select_sdb');
    $sdb->add_options(array(
    //ceci ne fonctionne pas (choisissez un etat)    
    ''  => '- Combien de salle de bain ? -',
    '1' => '1',
    '2 '=> '2',
    '3' => '3',
    '4' => '4',
    '5' => '5'
    ));
    
    ////label et text des coûts des travaux
    $form_maison->add('label','label_cout_travaux', 'cout_travaux', 'Coût travaux');
    $cout_travaux = $form_maison->add('text', 'cout_travaux', null, array(
                                    'maxlength' => 50
                                ));
    
    //label et text de la remarque
    $form_maison->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_maison->add('textarea', 'remarque', null, array(
                                    'maxlength' => 50
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_maison->add('submit', 'btnsubmit', 'Submit');
    
    $form_maison->render('view/templates/tpl_maisons.php');

