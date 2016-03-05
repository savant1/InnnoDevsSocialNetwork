<?php
session_start();
require("includes/init.php");
include('filters/auth_filters.php');

    if(!empty($_GET['id'])){
        if(user_has_already_like_the_micropost($_GET['id'])){
            unlike_micropost($_GET['id']);
        } else{
            set_flash("vous n'aimez plus ce commentaire",'info');
            redirect('profile.php?id='.get_session('user_id').'#micropost'.$_GET['id']);
        }
    }
set_flash("vous n'aimez plus ce commentaire",'info');
redirect('profile.php?id='.get_session('user_id').'#micropost'.$_GET['id']);