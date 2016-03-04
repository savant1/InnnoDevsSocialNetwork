<?php
session_start();
//chargement de la connection auto
require ("includes/init.php");
//importation des filtres
include "filters/auth_filters.php";

if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')){
    $q = $db->prepare("UPDATE freinds_relationships
                       SET statut = '1'
                       WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2)
                       OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
    $q->execute([
        'user_id1' => get_session('user_id'),
        'user_id2' => $_GET['id']
    ]);
    set_flash("vous etes maintenant ami","success");
    redirect('profile.php?id='. $_GET['id']);
}else{
    redirect('profile.php?id='.get_session('user_id'));
}