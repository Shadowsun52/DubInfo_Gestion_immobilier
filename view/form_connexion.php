<h2>Connexion</h2>
<div id="formulaire">
<?php
    use DubInfo_gestion_immobilier\model\User;
    $form_connexion = new Zebra_Form('form_connexion');
    $form_connexion->language("francais");
    
    $form_connexion->add('label','label_login', 'login_crm', 'Login');
    $login = $form_connexion->add('text', 'login_crm', null, array(
                                    'maxlength' => User::MAX_SIZE_LOGIN
                                ));
    $login->set_rule(array(
               'required' => array('error', 'Le login est requis!'), 
            ));
    $form_connexion->add('label','label_password', 'password', 'Mot de passe');
    $password = $form_connexion->add('password', 'password', null, array(
                                    'maxlength' => User::MAX_SIZE_PASSWORD
                                ));
    $password->set_rule(array(
               'required' => array('error', 'Le mot de passe est requis!'), 
            ));
    //Il ne faut pas oublier d'ajouter le bouton submit
    $form_connexion->add('submit', 'btnsubmit', 'Connexion');
    
    $form_connexion->render();
    if(isset($_POST['login_crm'])) {
        echo '<p class="error_connexion">Le couple login / mot de passe est incorrecte</p>';
    }
?>
</div>