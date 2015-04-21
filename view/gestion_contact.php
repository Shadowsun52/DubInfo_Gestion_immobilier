<h2>Gestion des contacts</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\Contact;
    
    $form_contact = new Zebra_Form('form_contact');
    $form_contact->language("francais");
    
    //création de la liste des contacts
//    $business = new LocataireCRUD();
    $list_contacts[''] = '- Nouveau -';
//    foreach ($business->readList() as $contact) {
//        $list_contacts[$contact->getId()] = $contact->toString();
//    }
    
    //liste déroulante avec les contacts déjà existants
    $form_contact->add('label','label_id', 'select_id', 'Liste des Contacts');
    $id = $form_contact->add('select', 'select_id');
    $id->add_options($list_contacts ,TRUE);
    
    $form_contact->add('label','label_nom', 'nom', 'Nom');
    $nom = $form_contact->add('text', 'nom', null, array(
                                    'maxlength' => Contact::MAX_SIZE_NOM
                                ));
    $nom->set_rule(array(
               'required' => array('error', 'Nom requis!'), 
            ));
    
    $form_contact->add('label','label_prenom', 'prenom', 'Prénom');
    $prenom = $form_contact->add('text', 'prenom', null, array(
                                    'maxlength' => Contact::MAX_SIZE_PRENOM
                                ));
    
    $form_contact->add('label','label_num_tel', 'num_tel', 'Numéro de téléphone');
    $num_tel = $form_contact->add('text', 'num_tel', null, array(
                                    'maxlength' => Contact::MAX_SIZE_NUM
                                ));
    
    $form_contact->add('label','label_num_gsm', 'num_gsm', 'Numéro de Gsm');
    $num_gsm = $form_contact->add('text', 'num_gsm', null, array(
                                    'maxlength' => Contact::MAX_SIZE_NUM
                                ));
    
    $form_contact->add('label','label_mail', 'mail', 'Adresse email');
    $mail = $form_contact->add('text', 'mail', null, array(
                                    'maxlength' => Contact::MAX_SIZE_MAIL
                                ));
    
    //remarque
    $form_contact->add('label','label_remarque', 'remarque', 'Remarque');
    $remarque = $form_contact->add('textarea', 'remarque', null, array(
                                    'maxlength' => Contact::MAX_SIZE_COMMENTAIRE
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_contact->add('submit', 'btnsubmit', 'Ajouter');
    
    $form_contact->render('view/templates/tpl_contact.php');
?>
</div>