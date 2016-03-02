<?php $title = 'Inscription';?>
<?php include ('partials/_header.php');?>

        <div id="main-content">
            <div class="container">

                <h1 class="lead"><?= $long_texte['devenez_membre'][$_SESSION['locale']]; ?> !!!</h1>


                <?php
                    //inclusions du fichier contenant la liste des erreurs.
                    include('partials/_errors.php');
                ?>

                <form data-parsley-validate method="post" class="well col-md-6">

                    <!--champ pour le nom-->
                    <div class="form-group">
                        <label for="name" class="control-label"><?= $menu['nom'][$_SESSION['locale']]; ?>:</label>
                        <input type="text" class="form-control" value="<?= get_input('name')?>" id="name" name="name" required="required"
                               data-parsley-minlength="6">
                    </div>

                    <!--champ pour le pseudo-->
                    <div class="form-group">
                        <label for="pseudo" class="control-label"><?= $menu['pseudo'][$_SESSION['locale']]; ?>:</label>
                        <input type="text" class="form-control" value="<?= get_input('pseudo')?>" id="pseudo" name="pseudo" required="required"
                            data-parsley-minlength="6">
                    </div>

                    <!--champ pour l'email-->
                    <div class="form-group">
                        <label for="email" class="control-label"><?= $menu['email'][$_SESSION['locale']]; ?>:</label>
                        <input type="email" class="form-control" value="<?= get_input('email')?>" id="email" name="email" required="required"
                            data-parsley-trigger="change">
                    </div>

                    <!--champ pour le password-->
                    <div class="form-group">
                        <label for="password" class="control-label"><?= $menu['Mot_De_Passe'][$_SESSION['locale']]; ?>:</label>
                        <input type="password" class="form-control" id="password" name="password" required="required"
                               data-parsley-minlength="6">
                    </div>

                    <!--champ pour le password de confirmation-->
                    <div class="form-group">
                        <label for="password_confirm" class="control-label"><?= $menu['confirmation_mdp'][$_SESSION['locale']]; ?>:</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required="required"
                               data-parsley-equalto="#password">
                    </div>

                    <input type="submit" class="btn btn-primary" name="register" value="<?= $menu['inscription'][$_SESSION['locale']]; ?>">
                </form>

            </div>
        </div><!-- /.container -->
<?php include('partials/_footer.php');?>