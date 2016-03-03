<?php $title = 'Changer de mot de passe';?>
<?php include ('partials/_header.php');?>
<div id="main-content">
    <div class="container">
        <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= $menu['change_password'][$_SESSION['locale']]; ?></h3>
                        </div>
                        <div class="panel-body">
                            <?php include('partials/_errors.php'); ?>
                            <form data-parsley-validate method="post" autocomplete="off">
                                  <div class="form-group">
                                      <label for="current_password"><?= $menu['Mot_De_Passe'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                      <input type="password" name="current_password" id="current_password" class="form-control" required="required"
                                        >
                                  </div>
                                  <div class="form-group">
                                      <label for="new_password"><?= $menu['new_password'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                      <input type="password" name="new_password" id="new_password" class="form-control" required="required"
                                      data-parsley-minlength="6"  >
                                  </div>
                                  <div class="form-group">
                                      <label for="new_password_confirmation"><?= $menu['new_password_confirmation'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                      <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required="required"
                                      data-parsley-equalto="#new_password"  >
                                  </div>
                                <input type="submit" name="change_password" class="btn btn-info" value="<?= $menu['change_password'][$_SESSION['locale']]; ?>">
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div><!-- /.container -->
</div>
<?php include('partials/_footer.php');?>
