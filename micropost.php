<?php
//demarage de la session pour le transport des infos
session_start();
//chargement de la connection auto
require ("includes/init.php");

//filtrage des invites
include "filters/auth_filters.php";

// si le formulaire est soumis

if(isset($_POST['publish'])){

    if(!empty($_POST['content'])){
        extract($_POST);

       create_micropost_for_the_current_user($content);

        set_flash($menu['statut_a_jour'][$_SESSION['locale']],'success');//
    } else {
        set_flash($menu['no_content_send'][$_SESSION['locale']],'warning');
    }
}

redirect('profile.php?id='.get_session(user_id));