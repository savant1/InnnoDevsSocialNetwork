<?php $title = 'Connexion';?>
<?php include ('partials/_header.php');?>

        <div id="main-content">
            <div class="container">

                <h1 class="lead"><?= $menu['connexion'][$_SESSION['locale']]; ?> !!!</h1>


                <?php
                //inclusions du fichier contenant la liste des erreurs.
                include('partials/_errors.php');
                ?>

                <form data-parsley-validate method="post" class="well col-md-6">

                    <!--champ pour l'identifiant-->
                    <div class="form-group">
                        <label for="identifiant" class="control-label"><?= $menu['pseudo_email'][$_SESSION['locale']]; ?>:</label>
                        <input type="text" class="form-control" value="<?= get_input('identifiant')?>" id="identifiant" name="identifiant" required="required"
                               data-parsley-minlength="6">
                    </div>


                    <!--champ pour le password
                    <div class="form-group">-->
                        <label for="password" class="control-label"><?= $menu['Mot_De_Passe'][$_SESSION['locale']]; ?>:</label>
                        <input type="password" class="form-control" id="password" name="password" required="required"
                               data-parsley-minlength="6">



                    <!--set active-->
                    <div class="form-group">
                        <label for="remember_me" class="control-label">
                            <input type="checkbox" class="form-control" id="remember_me" name="remerber_me">Garder ma session active
                        </label>
                    </div>

                    <input type="submit" class="btn btn-primary" name="login" value="<?= $menu['connexion'][$_SESSION['locale']]; ?>">
                </form>

            </div>
        </div><!-- /.container -->
<?php include('partials/_footer.php');?>