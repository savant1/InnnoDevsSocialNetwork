<?php
//demarage de la session pour le transport des infos
session_start();
//chargement de la connection auto
require ("includes/init.php");
//filtrage des invites
include ('filters/auth_filters.php');

if(!empty($_GET['id'])){
    $data = find_code_by_id($_GET['id']);
        if($data){
            $code = $data->code;
        } else{
            $code = "";
        }
}

// si le formulaire est soumis

if(isset($_POST['save'])){
    if(not_empty(['code'])){
        extract($_POST);

        $q = $db->prepare('INSERT INTO codes (code) VALUES (?)');
        $success = $q->execute([$code]);

        if($success){
            $id = $db->lastInsertId();
            redirect('show_code.php?id='.$id);
        }else{
            set_flash("Erreur lors du partage du code sources bien voulloir reprendre la procedure","danger");
            redirect('share_code.php');
        }
    }else {
        redirect('share_code.php');
    }
}

?>



<?php require ("views/share_code.views.php");?>