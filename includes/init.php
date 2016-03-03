<?php

//importation de la connexion a la bd
require ("config/database.php");
//chargement des fonctions
require ("includes/functions.php");
//chargement des fonctions
require ("includes/constants.php");
//chargement du multilangue
require ("bootstrap/locale.php");

        if(!empty($_COOKIE['pseudo']) && !empty($_COOKIE['user_id'])){
            $_SESSION['pseudo'] = $_COOKIE['pseudo'];
            $_SESSION['user_id'] = $_COOKIE['user_id'];
            $_SESSION['avatar'] = $_COOKIE['avatar'];
        }

        auto_login();