<?php $title = 'Modification De Profil';?>
<?php include ('partials/_header.php');?>
        <div id="main-content">
            <div class="container">
                <div class="row">
                    <?php if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id') ) : ?>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?= $menu['complete_profil'][$_SESSION['locale']]; ?></h3>
            </div>
            <div class="panel-body">
                <?php include('partials/_errors.php'); ?>
                <form data-parsley-validate method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name"><?= $menu['nom'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" required="required"
                                       value="<?= get_input('name') ? get_input('name') :  e($user->name)?>"
                                       placeholder="ferry francois bakongo">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city"><?= $menu['ville'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                <input type="text" name="city" id="city" class="form-control" required="required"
                                       value="<?= get_input('city') ? get_input('city') : e($user->city)?>"
                                       placeholder="Douala">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="avatar"> Changer ma photo de profil !!!</label>
                                <input type="file" name="avatar" id="avatar" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="country"><?= $menu['pays'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                <input type="text" name="country" id="country" class="form-control" required="required"
                                       value="<?= get_input('country') ? get_input('country') : e($user->country)?>"
                                       placeholder="Cameroun">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="sex"><?= $menu['sexe'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                <select name="sex" id="sexe" class="form-control" required="required">
                                    <option value="M" <?= $user->sex == 'M' ? "selected" : ""?> >Homme</option>
                                    <option value="F" <?= $user->sex == 'F' ? "selected" : ""?> >Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="twitter"><?= $menu['twitter'][$_SESSION['locale']]; ?> </label>
                                <input type="text" name="twitter" id="twitter" class="form-control"
                                       value="<?= get_input('twitter') ? get_input('twitter') : e($user->twitter)?>"
                                       placeholder="@ferryfrancois">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="github"><?= $menu['github'][$_SESSION['locale']]; ?> </label>
                                <input type="text" name="github" id="github" class="form-control"
                                       value="<?= get_input('github') ? get_input('github') : e($user->github)?>"
                                       placeholder="savant1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="available_for_haring">
                                    <input type="checkbox" name="available_for_haring" id="available_for_haring"
                                        <?= $user->available_for_haring == '1' ? "checked" : ""?> >
                                    <?= $menu['emploie'][$_SESSION['locale']]; ?> ?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bio"><?= $menu['bio'][$_SESSION['locale']]; ?> <span class="text-danger">*</span></label>
                                               <textarea name="bio" id="bio" cols="30" rows="5" class="form-control"
                                                         placeholder="ce que vous desirez faire connaitre sur vous!!!"  ><?= get_input('bio') ? get_input('bio') : e($user->bio)?></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="update" class="btn btn-info" value="<?= $menu['val'][$_SESSION['locale']]; ?>">
                </form>
            </div>
        </div>
    </div>
<?php endif ?>
                </div>
            </div><!-- /.container -->
        </div>

<!-- Bootstrap core JavaScript
https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.3.5/parsley.min.js
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="libaries/parsley/parsley.min.js"></script>
<script src="libaries/alertifyjs/alertify.min.js"></script>
<script src="libaries/uploadify/jquery.uploadify.min.js"></script>
<script src="libaries/parsley/i18n/fr.js"></script>
<script src="assets/js/jquery.livequery.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#avatar').uploadify({
            'fileObjName' : 'avatar',
            'fileTypeDesc' : 'Images Files',
            'fileTypeExts' : '*.gif;*.jpg;*.png;*.GIF;*.JPG;*.PNG;*.jpeg;*.JPEG',
            'buttonText':'Parcourir',
            'formData'    : {
                'timestamp' : '<?php echo $timestamp;?>',
                'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                'user_id'   : "<?= get_session('user_id')?>",
                '<?php echo session_name(); ?>' : '<?php echo session_id(); ?>'
            },
            'swf'      : 'libaries/uploadify/uploadify.swf',
            'uploader' : 'libaries/uploadify/uploadify.php',
            'onUploadComplete' : function(file) {
                alertify.complete('The file ' + file.name + ' progression terminer.');
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alertify.error("Erreur lors de l'upload du fichier bien voulloir ressayer");
            },
            'onUploadSuccess' : function(file, data, reponse) {
                alertify.success("votre avatar a ete uploader avec success");
                window.location = 'profile.php';
            }



            // Put your options here
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("span.timeago").timeago();
    });
    $('span.timeago')
        .livequery(function(){
            $("span.timeago").timeago();
    });
   // window.ParsleyValidator.setLocale('fr');
</script>

</body>
</html>
