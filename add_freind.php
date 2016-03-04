<?php
session_start();
//chargement de la connection auto
require ("includes/init.php");
//importation des filtres
include "filters/auth_filters.php";

    if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')){
        if(!a_freind_resquest_has_already_been_sent(get_session('user_id'),$_GET['id'])){
            $q = $db->prepare("INSERT INTO freinds_relationships (user_id1, user_id2) VALUES (?,?)");
            $q->execute([ get_session('user_id'), $_GET['id']]);

            // sauvegarde de la notification
            $q = $db->prepare('INSERT INTO notifications (subject_id, name, user_id)
                                   VALUES(:subject_id, :name, :user_id)');
                                 $q->execute([
                                             'subject_id' => $_GET['id'],
                                             'name' => 'friend_request_sent',
                                             'user_id' => get_session('user_id'),
                                 ]);
            set_flash("votre demande d'amitie a ete envoye avec succes","success");
            redirect('profile.php?id='. $_GET['id']);
        }else{
            set_flash("Vous avez une demande d'amitier de cet utilisateur en attente bien vouloir la confirmer","success");
            redirect('profile.php?id='. $_GET['id']);
        }

    }else{
        redirect('profile.php?id='.get_session('user_id'));
    }