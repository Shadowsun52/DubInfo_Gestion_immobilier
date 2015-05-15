<?php
use DubInfo_gestion_immobilier\business\UserCRUD;
use DubInfo_gestion_immobilier\model\User;
if(isset($_POST['login_crm'])) {
    $business = new UserCRUD();
    $user = new User();
    $user->setLogin($_POST['login_crm']);
    $user->setPassword($_POST['password']);
    if($business->checkConnexion($user)) {
        $_SESSION['login_crm'] = $user->getLogin();
    }
}
elseif (isset($_POST['deconnexion'])) {
    unset($_SESSION['login_crm']);
}