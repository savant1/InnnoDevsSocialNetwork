<?php
session_start();
//chargement de la connection auto
require ("includes/init.php");
//importation des filtres
include "filters/auth_filters.php";


// si le formulaire est soumis

if(isset($_POST['change_password'])){
    $errors = [];

    //si tous les champs sont remplis
    if(not_empty(['current_password','new_password','new_password_confirmation'])){
        extract($_POST);

        //verification du matching des password
        if(mb_strlen($new_password) < 6){
            $errors[] ='Votre mot de passe est tres court bien voulloir le completer';
        } else {
            if($new_password != $new_password_confirmation){
                $errors[] ='Les deux mots de passe se concordent pas !!! :-)';
            }
        }

        //verifions si on a pas d'erreurs
        if(count($errors) == 0){
            $q = $db->prepare("SELECT password  AS hashed_password FROM users
                                     WHERE (id = :id)
                                     AND active = '1'");
            $q->execute([
                'id' => get_session('user_id')
            ]);

            $user = $q->fetch(PDO::FETCH_OBJ);

            if($user && bcrypt_verify_password($current_password , $user->hashed_password)){

                $q = $db->prepare("UPDATE users
                                       SET password = :password
                                       WHERE  id = :id");
                $q->execute([
                    'password' => bcrypt_hash_password($new_password),
                    'id' => get_session('user_id')
                ]);

                set_flash("votre mot de passe a ete mis a jour","success");
                redirect('profile.php?id='.get_session('user_id'));

            }else{
                save_input_data();
                $errors[] ='votre mot de passe actuel est invalide';
                set_flash("votre mot de passe ne peut etre mis a jour","danger");
            }
        }else{
            set_flash("no user","warning");
        }

    } else{
        save_input_data();
        $errors[] ='Bien voulloir remplir tous les champs marqués de (*) SVP // Please try to complete all the fields end with (*)';
    }
} else{
    clear_input_data();
}

require ("views/change_password.view.php");