<?php
//demarage de la session pour le transport des infos
session_start();
//chargement de la connection auto
require ("includes/init.php");
//filtrage des invites
include "filters/auth_filters.php";
//connexion a la base de donnee
require('config/database.php');
//importation de la bibliotheques qui va exceuter nos functions
require('includes/functions.php');
//import des langues
require ("bootstrap/locale.php");

// si le formulaire est soumis

if(isset($_POST['publish'])){

    if(!empty($_POST['content'])){
        extract($_POST);

        $q = $db->prepare("INSERT INTO microposts (content, user_id) VALUES (:content,:user_id)");
        $q->execute([
            'content' => $content,
            'user_id' => get_session('user_id')
        ]);

        set_flash('votre statut a étè mis a jour','success');
    } else {
        set_flash("vous n'avez fourni aucun contenu",'warning');
    }
}

redirect('profile.php?id='.get_session(user_id));