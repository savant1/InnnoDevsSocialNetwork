<?php
session_start();

//chargement de la connection auto
require ("includes/init.php");
//filtrage des invites
  include "filters/auth_filters.php";

//chargement de la vue
  require ("views/index.veiws.php");