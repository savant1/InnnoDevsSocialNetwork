<?php $title = 'Page De Profil';?>
<?php include ('partials/_header.php');?>
        <div id="main-content">
            <div class="container">
                <div class="row">

                   <div class="col-sm-6">
                       <div class="panel panel-info">
                           <div class="panel-heading">
                               <h3 class="panel-title"><?= $menu['profil'][$_SESSION['locale']]; ?> <?= e($user->pseudo) ?></h3>
                           </div>
                           <div class="panel-body">
                               <div class="row">
                                   <div class="col-sm-5">
                                       <img src="<?= $user->avatar ? $user->avatar : get_avatar_url($user->email) ?>"
                                            alt="Image de profil de <?= e($user->pseudo) ?>" class="avatar-md"><br>
                                   </div>
                                   <div class="col-sm-7">
                                       <?php if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id') ) : ?>
                                            <?php include('partials/_relation_link.php'); ?>
                                       <?php endif; ?>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-6">
                                       <strong><?= e($user->pseudo) ?></strong> <br>
                                       <a href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a>
                                       <br><?=
                                       $user->city && $user->country ? '<i class="fa fa-location-arrow"></i> '.
                                           e($user->city).' - '.e($user->country).' <br>' : "";
                                       ?> <br>
                                       <a href="https://www.google.com/maps?q=<?= e($user->city).' '.e($user->country) ?>"
                                          target="_blank"> <?= $menu['map'][$_SESSION['locale']]; ?></a>

                                   </div>
                                   <div class="col-sm-6">
                                       <?=
                                            $user->twitter ? '<i class="fa fa-twitter"></i> <a target="_blank" href="//twitter.com/'.e($user->twitter).'">@'.e($user->twitter).'</a><br>' : "";
                                       ?>
                                       <?=
                                            $user->github ? '<i class="fa fa-github"></i> <a target="_blank" href="//github.com/'.e($user->github).'">'.e($user->github).'</a><br>' : "";
                                       ?>
                                       <?=
                                            $user->sex == "F" ? '<i class="fa fa-female"></i>' : '<i class="fa fa-male"></i>';
                                       ?>
                                       <?=
                                            $user->available_for_haring ?  $menu['emploie'][$_SESSION['locale']] : $menu['emploiec'][$_SESSION['locale']] ;
                                       ?>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-sm-12 well">
                                       <h5> <?= $menu['pbio'][$_SESSION['locale']]; ?> <?= e($user->name)?></h5>
                                       <p>
                                           <?=
                                                $user->bio ? nl2br(e($user->bio)) : $menu['pbioc'][$_SESSION['locale']];
                                           ?>
                                       </p>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="col-sm-6">
                       <?php if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) : ?>
                           <div class="status-post">
                               <form action="micropost.php" method="post" data-parsley-validate>
                                   <div class="form-group">
                                       <label for="content" class="sr-only"><?=  $menu['statut'][$_SESSION['locale']]; ?> :</label>
                                   <textarea name="content" id="content" rows="3" class="form-control"
                                             placeholder="<?=  $menu['pub_mur'][$_SESSION['locale']]; ?>"required="required"
                                             data-parsley-minlength="3"  data-parsley-maxlength="140"></textarea>
                                   </div>
                                   <div class="from-group status-post-submit">
                                       <input type="submit" value="<?=  $menu['publier'][$_SESSION['locale']]; ?>" name="publish" class="btn btn-default btn-xs">
                                   </div>
                               </form>
                           </div>
                       <?php endif; ?>

                       <?php if(count($microposts) != 0 ) :?>
                           <?php foreach ($microposts AS $micropost):?>
                                <?php include('partials/_micropost.php');?>
                           <?php endforeach; ?>
                       <?php else: ?>
                            <p class="text-center">
                               <?=  $long_texte['no_micropost'][$_SESSION['locale']]; ?>
                            </p>
                       <?php endif; ?>
                   </div>
                </div>
            </div>
        </div><!-- /.container -->
<!-- Bootstrap core JavaScript
https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.3.5/parsley.min.js
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="libaries/parsley/parsley.min.js"></script>
<script src="libaries/parsley/i18n/fr.js"></script>
<script src="assets/js/jquery.livequery.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("span.timeago").timeago();
    });
    $('span.timeago')
        .livequery(function(){
            $("span.timeago").timeago();
        });
    window.ParsleyValidator.setLocale('fr');
</script>

</body>
</html>