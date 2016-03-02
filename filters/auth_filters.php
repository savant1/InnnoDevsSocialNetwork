<?php

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['pseudo'])){

        $_SESSION['forwardind_url'] = $_SERVER['REQUEST_URI'];

        $_SESSION['notification']['message'] = 'Vous devez etre connecte pour acceder a cette page!!!' ;
        $_SESSION['notification']['type'] = 'danger';
        header('Location:login.php');
        exit();
    }
