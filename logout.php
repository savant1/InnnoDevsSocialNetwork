<?php
/**
 * Created by PhpStorm.
 * User: ferry francois
 * Date: 23/02/2016
 * Time: 18:06
 */

    session_start();
    session_destroy();

    $_SESSION = [];

    setcookie('pseudo','',time()-3600*25*365);
    setcookie('user_id','',time()-3600*25*365);
    setcookie('avatar','',time()-3600*25*365);

    header('Location:login.php');
    exit();

?>