<h2>Gestion des professionnels</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Professionnel;
    use DubInfo_gestion_immobilier\model\Adresse;
    use DubInfo_gestion_immobilier\business\MetierCRUD;
    //formulaire qui permet de gérer les professionnels
    
    $form_professionnel = new Zebra_Form('form_professionnel');
    $form_professionnel->language("francais");
    
    //création de la liste des professionnels
//    $business = new InvestisseurCRUD();
    $list_pro[''] = '- Nouveau -';
//    foreach ($business->readList() as $investisseur) {
//        $list_invest[$investisseur->getId()] = $investisseur->getNom() . ' ' .
//                $investisseur->getPrenom();
//    }
    
    //liste déroulante avec les investisseurs déjà existant
    $form_professionnel->add('label','label_id', 'select_id', 'Liste des professionnels');
    $id = $form_professionnel->add('select', 'select_id');
    $id->add_options($list_pro ,TRUE);
    
    $form_professionnel->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_professionnel->add('text', 'nom', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_NOM
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_professionnel->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_professionnel->add('text', 'prenom', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_PRENOM
                                ));
    
    $form_professionnel->add('label','label_metier', 'select_metier', 'Métier');
    $business_metier = new MetierCRUD();
    $list_metiers[''] = '- Choisissez un métier -';
    foreach ($business_metier->readList() as $metier) {
        $list_metiers[$metier->getId()] = $metier->getLibelle();
    }
    
    $metier = $form_professionnel->add('select', 'select_metier');
    $metier->add_options($list_metiers);
    
    $form_professionnel->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_professionnel->add('text', 'num_tel', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_NUM
                                ));
    
    $form_professionnel->add('label','label_num_gsm', 'num_gsm', 'Numéro de Gsm');
    $num_gsm = $form_professionnel->add('text', 'num_gsm', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_NUM
                                ));
    
    $form_professionnel->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_professionnel->add('text', 'mail', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_MAIL
                                ));
    $mail->set_rule(array(
                'email'    => array('error', 'L\'adresse email est incorrecte!'),
            ));
    
    $form_professionnel->add('label','label_num_tva', 'num_tva', 'Numéro de TVA');
    $tva = $form_professionnel->add('text', 'num_tva', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_TVA
                                ));
    
    $form_professionnel->add('label','label_rue', 'rue', 'Rue');
    $num_gsm = $form_professionnel->add('text', 'rue', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_RUE
                                ));
    $form_professionnel->add('label','label_numero', 'numero', 'N°');
    $num_gsm = $form_professionnel->add('text', 'numero', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_NUMERO
                                ));
    
    $form_professionnel->add('label','label_boite', 'boite', 'Boîte');
    $num_gsm = $form_professionnel->add('text', 'boite', null, array(
                                    'maxlength' => Adresse::MAX_SIZE_BOITE
                                ));
    
    //liste déroulante avec les 3 pays possibles ou autre, si c'est un pays différent des trois proposés
    $form_professionnel->add('label','label_pays', 'select_pays', 'Pays');
    $pays = $form_professionnel->add('select', 'select_pays');
    $pays->add_options(array(
    //ceci ne fonctionne pas (choisissez un pays)    
    ''  => '- Choisissez un pays -',
    'Belgique' => 'Belgique',
    'France'=> 'France',
    'Luxembourg' => 'Luxembourg',
    'Autre' => 'Autre'
    ), true);
    
    //ld avec les CP
    $form_professionnel->add('label','label_cp', 'select_cp', 'Code postal');
    $cp = $form_professionnel->add('select', 'select_cp');
    $cp->add_options(array(
        '' => '- choisissez un code postal -'
    ),true);
            
    //ld avec les villes
    $form_professionnel->add('label','label_villes', 'select_villes', 'Ville');
    $villes = $form_professionnel->add('select', 'select_villes');
    $villes->add_options(array(
        '' => '- choisissez une ville -'
    ),true);
    
    $form_professionnel->add('label','label_remarque', 'remarque', 'Commentaires');
    $num_gsm = $form_professionnel->add('textarea', 'remarque', null, array(
                                    'maxlength' => Professionnel::MAX_SIZE_COMMENTAIRE
                                ));
    
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_professionnel->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_professionnel->render('view/templates/tpl_professionnel.php');

?>

</div>