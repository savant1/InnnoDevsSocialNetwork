<?php $title = 'Acceuil';?>
<?php include ('partials/_header.php');?>

    <div id="main-content">
        <div class="container">
            <div class="jumbotron">
                <h1 class="lead"><?= WEBSITE_NAME;?> ?</h1>
                <p>
                    <?= WEBSITE_NAME;?> <?= $long_texte['acceuil_intro'][$_SESSION['locale']]; ?> <?= WEBSITE_NAME;?> !
                </p>
                <a href="register.php" class="btn  btn-primary btn-lg"><?= $long_texte['cree_un_compte'][$_SESSION['locale']]; ?></a>
            </div>
        </div>
    </div><!-- /.container -->
<?php include('partials/_footer.php');?>