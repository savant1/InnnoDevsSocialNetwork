
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME;?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="list_users.php"><?= $menu['liste_user'][$_SESSION['locale']]; ?></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="<?= set_active('index') ?> "> <a href="index.php"><?= $menu['acceuil'][$_SESSION['locale']]; ?></a></li>
                <?php if(is_logged_in()) : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= get_session('avatar') ? get_session('avatar') : get_avatar_url(get_session('email'),$size = 25) ?>"
                                 alt="Image de profil de <?= get_session('pseudo') ?>" class="img-circle avatar-xs">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="<?= set_active('profile') ?> ">
                                <a href="profile.php?id=<?=get_session('user_id')?>">
                                    <?= $menu['mon profile'][$_SESSION['locale']]; ?>
                                </a>
                            </li>
                            <li class="<?= set_active('change_password') ?> ">
                                <a href="change_password.php">
                                    <?= $menu['change_password'][$_SESSION['locale']]; ?>
                                </a>
                            </li>
                            <li class="<?= set_active('edit_user') ?> ">
                                <a href="edit_user.php?id=<?=get_session('user_id')?>">
                                    <?= $menu['editer profile'][$_SESSION['locale']]; ?>
                                </a>
                            </li>
                            <li class="<?= set_active('share_code') ?> ">
                                <a href="share_code.php"><?= $menu['partager'][$_SESSION['locale']]; ?></a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><?= $menu['deconnexion'][$_SESSION['locale']]; ?></a></li>
                        </ul>
                    </li>
                    <li class=" <?= $notifications_count > 0 ? 'have_notifs' : '' ?> ">
                        <a href="notifications.php">
                            <i class="fa fa-bell"></i>
                            <?= $notifications_count > 0 ? "($notifications_count)" : '(0)'; ?>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="<?= set_active('login') ?> "><a href="login.php"><?= $menu['connexion'][$_SESSION['locale']]; ?></a></li>
                    <li class="<?= set_active('register') ?> "><a href="register.php"><?= $menu['inscription'][$_SESSION['locale']]; ?></a></li>
                <?php endif?>
                <ul class="nav navbar-nav navbar-right" style="padding-top: 10px">
                    <a href="?lang=fr"> <img src="img/france.PNG" alt="" width="20px" height="20px"></a>
                    <a href="?lang=en"> <img src="img/angleterre.PNG" alt="" width="20px" height="20px"></a>
                    <a href="?lang=es"> <img src="img/espagnol.PNG" alt="" width="20px" height="20px"></a>
                    <a href="?lang=all"> <img src="img/allemand.PNG" alt="" width="20px" height="20px"></a>
                </ul>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>