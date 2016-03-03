<?php
//demarage de la session pour le transport des infos
session_start();
//chargement de la connection auto
require ("includes/init.php");
//filtrage des invites
include "filters/guest_filters.php";

// si le formulaire est soumis

if(isset($_POST['login'])){

    //si tous les champs sont remplis
    if(not_empty(['identifiant','password'])){
        extract($_POST);

        $q = $db->prepare("SELECT id , pseudo , email , avatar , password  AS hashed_password FROM users
                                     WHERE (pseudo = :identifiant OR email = :identifiant)
                                     AND active = '1'");
        $q->execute([
            'identifiant' => $identifiant,
        ]);

        $user = $q->fetch(PDO::FETCH_OBJ);

        if($user && bcrypt_verify_password($password , $user->hashed_password)){

            $_SESSION['user_id'] = $user->id;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['avatar'] = $user->avatar;
            $_SESSION['email'] = $user->email;
                // garder la session de l'utilisateur active
            if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'on'){
                remember_me($_SESSION['user_id']);
            }
            redirect_intent_or('profile.php?id='.$user->id);
        } else{
            set_flash("Combinaison identifiant / mot de passe invalide .Merci de verifier que votre compte soit activer (:- ", "danger");
            save_input_data();
        }

    } else{
        $errors[] ='Bien voulloir remplir tous les champs SVP// Please try to complete all the fields';
        save_input_data();
    }
} else{
    clear_input_data();
}



?>



<?php require ("views/login.views.php");?>