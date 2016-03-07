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
            $fullUrl = WEBSITE_URL. 'show_code.php?id='.$id ;
            create_micropost_for_the_current_user($menu['new_parta'][$_SESSION['locale']].$fullUrl);
            redirect('show_code.php?id='.$id);
        }else{
            set_flash($menu['err_new_parta'][$_SESSION['locale']],"danger");
            redirect('share_code.php');
        }
    }else {
        redirect('share_code.php');
    }
}

?>



<?php require ("views/share_code.views.php");?>