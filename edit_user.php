<?php
session_start();
//chargement de la connection auto
require ("includes/init.php");
//importation des filtres
include "filters/auth_filters.php";
//importation de la connexion a la bd
require ("config/database.php");
//importation des functions
require ("includes/functions.php");
//importation des constantes
require('includes/constants.php');
//import des langues
require ("bootstrap/locale.php");

if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id') ){
    //recuperons les infos du user grace a son id
    $user = find_user_by_id($_GET['id']);
    if(!$user){
        redirect('profil.php');
    }
} else {
    // redirection du user si ce dernier efface dans l'url son id alors on le detecte et on le redirige avec son id cool l'idee de mon frero
    redirect('edit_user.php?id='.get_session('user_id'));
}

    // si le formulaire est soumis

    if(isset($_POST['update'])){
        $errors = [];

        //si tous les champs sont remplis
        if(not_empty(['name','city','country','sex','bio'])){
            extract($_POST);

            $q = $db->prepare("UPDATE users
                                       SET name = :name , city = :city , country = :country ,
                                        sex = :sex , twitter = :twitter , github = :github ,
                                        bio = :bio , available_for_haring = :available_for_haring
                                        WHERE  id =:id");
            $q->execute([
                'name' => $name,
                'city' => $city,
                'country' => $country,
                'sex' => $sex,
                'twitter' => $twitter,
                'github' => $github,
                'bio' => $bio,
                'id' => get_session('user_id'),
                'available_for_haring' => !empty($available_for_haring) ? '1' : '0'
            ]);

            set_flash("votre profil a ete mise a jour","success");
            redirect('profile.php?id='.get_session('user_id'));

        } else{
            save_input_data();
            $errors[] ='Bien voulloir remplir tous les champs marqués de (*) SVP// Please try to complete all the fields end with (*)';
        }
    } else{
        clear_input_data();
    }

require ("views/edit_user.views.php");