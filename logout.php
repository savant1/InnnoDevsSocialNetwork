<?php
/**
 * Created by PhpStorm.
 * User: ferry francois
 * Date: 23/02/2016
 * Time: 18:06
 */

    session_start();

    require ('config/database.php');
        $q = $db->prepare("DELETE FROM auth_tokens WHERE user_id = ?");
        $q->execute([
                $_SESSION['user_id']
        ]);

    setcookie('auth','',time()-3600*25*365);

    session_destroy();

    $_SESSION = [];

    header('Location:login.php');
    exit();

?>