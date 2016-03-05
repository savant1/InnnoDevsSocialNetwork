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
            $q = $db->prepare("SELECT U.id user_id, U.pseudo, U.email, U.avatar, M.id m_id, M.content, M.created_at, M.like_count
                               FROM users U, microposts M, freinds_relationships F
                               WHERE M.user_id = U.id
                               AND

                                   CASE
                                       WHEN F.user_id1 = :user_id
                                       THEN F.user_id2 = M.user_id

                                       WHEN F.user_id2 = :user_id
                                       THEN F.user_id1 = M.user_id
                                   END

                               AND F.statut > 0
                               ORDER BY M.id DESC");
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