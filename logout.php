<?php
/**
 * Created by PhpStorm.
 * User: ferry francois
 * Date: 23/02/2016
 * Time: 18:06
 */

    session_start();

    //suppression du token en base de donnee pour le cas de deconnexion du client
    require ('config/database.php');
        $q = $db->prepare("DELETE FROM auth_tokens WHERE user_id = ?");
        $q->execute([$_SESSION['user_id']]);

    //definition de la liste des sessions a ne pas supprimer et reinitialisation de la session des langues
    $session_white_keys_list = ['locale'];
    //array_intersect_key permet de renvoyer la cle et la valeur des matching sur les deux tab
    //array_flip permet de renverser la cle de la valeur pour la comparaison sur des tab qui n'ont pas la meme def
    $new_session = array_intersect_key($_SESSION,array_flip($session_white_keys_list));
    $_SESSION = $new_session;

    //suppression des cookies
    setcookie('auth','',time()-3600*25*365);

    // redirection vers la sortie pour une new connexion
    header('Location:login.php');
    exit();
?>