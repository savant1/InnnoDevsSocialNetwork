<?php

    $autorize_languages = ['fr' , 'en' , 'es' , 'all'];

    if(!empty($_GET['lang']) && in_array($_GET['lang'],$autorize_languages)){
        $_SESSION['locale'] = $_GET['lang'];
    } else{
        if(empty($_SESSION['locale'])){
            $_SESSION['locale'] = $autorize_languages[0];
        }
    }

    require 'locales/memus.php';
    require 'locales/long_text.php';