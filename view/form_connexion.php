<h2>Connexion</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\User;
    $form_connexion = new Zebra_Form('form_connexion');
    $form_connexion->language("francais");
    
    $form_connexion->add('label','label_login', 'login', 'Login');
    $libelle = $form_connexion->add('text', 'login', null, array(
                                    'maxlength' => User::MAX_SIZE_LOGIN
                                ));
    $form_connexion->add('label','label_password', 'password', 'Mot de passe');
    $password = $form_connexion->add('password', 'password', null, array(
                                    'maxlength' => User::MAX_SIZE_PASSWORD
                                ));
    
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_connexion->add('submit', 'btnsubmit', 'Connexion');
    
    $form_connexion->render();
?>
</div>