<?php
    session_start();
    //filtrage des invites
    require "includes/init.php";
    include "filters/guest_filters.php";

    if(!empty($_GET['p']) && is_already_in_use('pseudo',$_GET['p'],'users') && !empty($_GET['token'])){
        $pseudo = $_GET['p'];
        $token = $_GET['token'];

        $q = $db->prepare("SELECT id , email , password FROM users WHERE pseudo = ?");
        $q->execute([$pseudo]);

        $data = $q->fetch(PDO::FETCH_OBJ);

        $token_verif = sha1($pseudo.$data->email.$data->password);

        if($token == $token_verif){
            //on active le compte du user
            $q = $db->prepare("UPDATE users SET active = '1' WHERE pseudo = ?");
            $q->execute([$pseudo]);
            // on le met en relation avec lui meme pour le systeme d'amie qui viendra plutard
            $q = $db->prepare("INSERT INTO freinds_relationships (user_id1, user_id2, statut) VALUES (:user_id1 , :user_id2 , :statut) ");
            $q->execute([
                'user_id1' => $data->id,
                'user_id2' => $data->id,
                'statut' => '2'
            ]);
            set_flash("Votre compte a bien ete activer bien voulloir vous loguez (:- ");
            redirect('login.php');
        }
        else{
            set_flash('Jeton de securite invalide / token isn\'t available'.$token.'//'.$token_verif,'danger');
            redirect('index.php');
        }
        die($data->email);
    }else{
        redirect('index.php');
    }