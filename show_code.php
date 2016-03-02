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
//importation des constantes
require('includes/constants.php');
//import des langues
require ("bootstrap/locale.php");

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