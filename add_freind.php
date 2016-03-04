<?php
session_start();
//chargement de la connection auto
require ("includes/init.php");
//importation des filtres
include "filters/auth_filters.php";

if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')){
    $q = $db->prepare("INSERT INTO freinds_relationships (user_id1, user_id2) VALUES (?,?)");
    $q->execute([ get_session('user_id'), $_GET['id']]);
    set_flash("votre demande d'amitie a ete envoye avec succes","success");
    redirect('profile.php?id='. $_GET['id']);
}else{
    redirect('profile.php?id='.get_session('user_id'));
}