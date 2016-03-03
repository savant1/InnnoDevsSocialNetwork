<?php
//demarage de la session pour le transport des infos
    session_start();
//chargement de la connection auto
require ("includes/init.php");
//filtrage des invites
include "filters/guest_filters.php";

    // si le formulaire est soumis

    if(isset($_POST['register'])){

        //si tous les champs sont remplis
        if(not_empty(['name','pseudo','email','password','password_confirm'])){

            $errors =[];//tableau qui vas porter toutes les erreurs lies a la mauvaise inscription du client

            extract($_POST);

            if(mb_strlen($pseudo) < 6){
                $errors[] ='Votre Pseudo est tres court bien voulloir le completer';
            }
            if(mb_strlen($password) < 6){
                $errors[] ='Votre mot de passe est tres court bien voulloir le completer';
            } else {
                if($password != $password_confirm){
                    $errors[] ='Les deux mots de passe se concordent pas !!! :-)';
                }
            }

            if(! filter_var($email , FILTER_VALIDATE_EMAIL)){
                $errors[] ='Adresse email incorrect bien voulloir la modifier';
            }


            if(is_already_in_use('pseudo',$pseudo,'users')){
                $errors[] ='pseudo deja utilise bien voulloir le changer// your pseudonyme is alreadyin use please change it to another';
            }


            if(is_already_in_use('email',$email,'users')){
                $errors[] ='email deja utilise bien voulloir le changer// your email is alreadyin use please change it to another';
            }

            if(count($errors) == 0){

                // Envoie du mail d'activation
                $to = $email;
                $subject = WEBSITE_NAME ."ACTIVATION DE COMPTE";
                $password = bcrypt_hash_password($password);
                $token = sha1($pseudo.$email.$password);
                $_SESSION['test']= $token;

                //creation d'une memoire tempon pour recuperer le template de la page d'activation de compte de mon site
                ob_start();
                    require ('templates/emails/activation.tmpl.php');
                // $content est donc la memoire tempom qui contient cette page la
                $content = ob_clean();

                $headers = 'MIME-Version: 1.0'."\r\n";
                $headers .= 'Content-type : text/html; charset=iso-8859-1'.'"\r\n"' ;

                //envoie du mail de confirmation
                mail($to,$subject,$content,$headers);

                //sauvegarde des infos dans la db
                $q = $db->prepare("INSERT INTO users (name , pseudo , email , password)
                                          VALUES (:name , :pseudo , :email , :password)");

                $q->execute([
                    'name' => $name,
                    'pseudo' => $pseudo,
                    'email' => $email,
                    'password' => $password
                ]);

               set_flash('mail d\'activation envoyer bien voulloir vous connectez a votre serveur de messagerie et activer votre compte' , 'success');
               redirect('index.php?p='.$pseudo.'&token='.$token);
            } else{
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



<?php require ("views/register.views.php");?>