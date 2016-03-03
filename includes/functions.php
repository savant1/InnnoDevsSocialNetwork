<?php

//function qui va echapper tous les champs en provenance du client de notre site
  if(!function_exists('e')){
      function e($string){
        if($string){
            return htmlspecialchars($string);
        }
      }
  }

//function qui va permettre de recuperer les sessions suivant la cle passer en paramettre
  if(!function_exists('get_session')){
      function get_session($key){
        if($key){
            return !empty($_SESSION[$key])
                ? e($_SESSION[$key])
                : null;
        }
      }
  }

//function qui va permettre de recuperer les infos d'un user suivant la cle passer en paramettre
  if(!function_exists('find_user_by_id')){
      function find_user_by_id($id){
          global $db;
        $q = $db->prepare('SELECT * FROM users WHERE id = ?');
        $q->execute([$id]);
        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();
            return $data;
      }
  }

//function qui va permettre de recuperer les infos d'un user suivant la cle passer en paramettre
  if(!function_exists('find_code_by_id')){
      function find_code_by_id($id){
          global $db;
          $q = $db->prepare("SELECT code FROM codes WHERE id = ?");
          $q->execute([$id]);
          $data = $q->fetch(PDO::FETCH_OBJ);
          $q->closeCursor();
            return $data;
      }
  }

//function qui va permettre de recuperer l'avatar d'un client en fonction de son adresse email
  if(!function_exists('get_avatar_url')){
      function get_avatar_url($email,$size = 100){
        return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".$size;
      }
  }

//function qui va permettre de recuperer l'etat de connection ou de deconnection du client
  if(!function_exists('is_logged_in')){
      function is_logged_in(){
        return isset($_SESSION['user_id']) || isset($_SESSION['pseudo']);
      }
  }

//function qui verifie si tous les champs sont pleins
  if(!function_exists('not_empty')){
      function not_empty($fields = []){
        if(count($fields != 0)){
            foreach($fields AS $field){
                if(empty($_POST[$field] || trim($_POST[$field]) == "")){
                    return false;
                }
            }
            return true;
        }
      }
  }

//function qui verifie l'unicite des valeurs
  if(!function_exists('is_already_in_use')){
      function is_already_in_use($field,$values,$table){
            global $db;
          $q = $db->prepare("SELECT id FROM $table WHERE $field = ?");
          $q->execute([$values]);
          $count = $q->rowCount();
          $q->closeCursor();
          return $count;
      }
  }

//function qui nous permet de styliser le message de confirmation d'envoie du mail
  if(!function_exists('set_flash')){
        function set_flash($message , $type){
            $_SESSION['notification']['message'] = $message;
            $_SESSION['notification']['type'] = $type;
        }
    }

//function qui nous permet de faire les redirection
  if(!function_exists('redirect')){
        function redirect($page){
            header('Location: '.$page);
            exit();
        }
    }

//function qui nous permet de faire les recuperations des donnees lors des erreurs generer
  if(!function_exists('save_input_data')){
        function save_input_data(){
           foreach($_POST as $key => $value){
              if(strpos($key,'password') === false){
                  $_SESSION['input'][$key] = $value;
              }
           }
        }
    }

//function qui nous permet de faire le retour d'information dans les champs apres recuperations des erreurs
  if(!function_exists('get_input')){
        function get_input($key){
            return !empty($_SESSION['input'][$key])
                    ? e($_SESSION['input'][$key])
                    : null;
        }
    }

//function qui nous permet de vider les champs en cas de success lors de l'inscription
  if(!function_exists('clear_input_data')){
        function clear_input_data(){
            if(isset($_SESSION['input'])){
                $_SESSION['input'] = [];
            }
        }
    }

//function qui va gerer l'etat actif de nos lien de menus
  if(!function_exists('set_active')){
    function set_active($file, $class = 'active'){
        $chemin = $_SERVER['SCRIPT_NAME'];
        $lui = explode("/",$chemin);
        $page = array_pop($lui);
        if($page == $file.'.php'){
            return $class;
        }else{
            return "";
        }
    }
}

//function qui va gerer la detection de langue
  if(!function_exists('get_current_locale')){
    function get_current_locale(){
        return $_SESSION['locale'];
    }
}

//function qui va gerer le hachage des mot de passe avec l'algo de Blowfish
  if(!function_exists('bcrypt_hash_password')){
    function bcrypt_hash_password($value , $options = array()){
        $cost = isset($options['round']) ? $options['round'] : 10;
        $hash = password_hash($value , PASSWORD_BCRYPT , array('cost' => $cost));
        if($hash === false){
            throw new Exception("l'algorithme de hachage n'est pas pris en compte sur cette version de serveur");
        }
         return $hash;
    }
}

//function qui va gerer la verification de hachage des mot de passe avec l'algo de Blowfish
  if(!function_exists('bcrypt_verify_password')){
    function bcrypt_verify_password($value , $hashedValue){
        return password_verify($value , $hashedValue);
    }
  }

//function qui va gerer la verification de hachage des mot de passe avec l'algo de Blowfish
  if(!function_exists('redirect_intent_or')){
    function redirect_intent_or($default_url){
       if($_SESSION['forwardind_url']){
           $url = $_SESSION['forwardind_url'];
       } else {
           $url = $default_url;
       }
        $_SESSION['forwardind_url'] = null;
        redirect($url);
    }
  }

//fonction qui va nous retourner les selecteurs existant en retournant le nombre de selecteur trouve
if(!function_exists('cell_count')){
    function cell_count($table,$field_name,$field_values){
        global $db;

        $q = $db->prepare("SELECT * FROM $table WHERE $field_name = ?");
        $q->execute([$field_values]);

        return $q->rowCount();
    }
}

// Remember me
if(!function_exists('remember_me')){
    function remember_me($user_id){
        global $db;
        //generation aleatoire du token
        $token = openssl_random_pseudo_bytes(24);

        //generation du selecteur de facon aleatoire et unique
        do{
            $selector = openssl_random_pseudo_bytes(9);
        } while (cell_count('auth_tokens','selector',$selector) > 0 );

        //enregistrement des infos en base de donnee
        $q = $db->prepare("INSERT INTO auth_tokens (selector, expires, user_id, token)
                           VALUES (:selector, DATE_ADD(NOW(),INTERVAL 14 DAY ) , :user_id, :token) ");
        $q->execute([
            'selector' => $selector,
            'user_id' => $user_id,
            'token' => hash('sha256',$token)
        ]);

        // ceration d'un cookies de securite qui expire apres 14 jours soit 2 semaines
        setcookie(
                    'auth',
                    base64_encode($selector).':'.base64_encode($token),
                    time()+ 1209600 ,
                    null,
                    null,
                    false,
                    true
        );
    }
}

// Auto Login
if(!function_exists('auto_login')){
    function auto_login(){
        global $db;
        //verification de l'existance du cookies
        if(!empty($_COOKIE['auth'])){
            //separation des elements selector et token
            $split = explode(':' ,$_COOKIE['auth']);
            if(count($split) != 2){
                return false;
            }
            //recuperation du selector et du token via le cookie
            list($selector,$token) = $split;
            $q = $db->prepare("SELECT auth_tokens.token,auth_tokens.user_id  , users.id , users.pseudo , users.avatar, users.email
                               FROM auth_tokens
                               LEFT JOIN users
                               ON auth_tokens.user_id = users.id
                               WHERE selector = ?
                               AND expires >= CURDATE() ");
            $q->execute([base64_decode($selector)]);
            $data = $q->fetch(PDO::FETCH_OBJ);
            if($data){
                //comparaison des tokens
                if(hash_equals($data->token,hash('sha256',base64_decode($token)))){
                      session_regenerate_id(true);
                    $_SESSION['user_id'] = $data->user_id;
                    $_SESSION['pseudo'] = $data->pseudo;
                    $_SESSION['avatar'] = $data->avatar;
                    $_SESSION['email'] = $data->email;
                    return true;
                }
            }
        }
        return false;
    }
}