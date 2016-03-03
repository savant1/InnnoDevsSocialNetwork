<?php
session_start();
//chargement de la connection auto
require ("includes/init.php");
//importation des filtres
include "filters/auth_filters.php";

    if(!empty($_GET['id'])){
        //recuperons les infos du user grace a son id
        $user = find_user_by_id($_GET['id']);
        if(!$user){
            redirect('profile.php');
        } else {
            $q = $db->prepare("SELECT content,created_at FROM microposts WHERE user_id = :user_id ORDER BY created_at DESC ");
            $q->execute([
                'user_id' => $_GET['id']
            ]);
            $microposts = $q->fetchAll(PDO::FETCH_OBJ);
        }
    } else {
        // redirection du user si ce dernier efface dans l'url son id alors on le detecte et on le redirige avec son id cool l'idee de mon frero
        redirect('profile.php?id='.get_session('user_id'));
    }



require ("views/profile.views.php");