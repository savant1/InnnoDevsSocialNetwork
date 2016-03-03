<?php
//demarage de la session pour le transport des infos
session_start();
//chargement de la connection auto
require ("includes/init.php");
//filtrage des invites
include "filters/auth_filters.php";

    if(!empty($_GET['id'])){
        $data = find_code_by_id($_GET['id']);
        if(!$data){
            redirect('share_code.php');
        }
    } else{
        redirect('share_code.php');
    }


?>



<?php require ("views/show_code.views.php");?>