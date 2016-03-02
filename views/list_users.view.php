<?php $title = 'Liste des Utilisateurs';?>
<?php include ('partials/_header.php');?>
<div id="main-content">
    <div class="container">
        <h1><?= $menu['liste_user'][$_SESSION['locale']]; ?></h1>
        <?php foreach(array_chunk($users ,4) AS $user_set): ?>
            <div class="row users">
                <?php foreach($user_set AS $user): ?>
                    <div class="col-sm-3 user-bloc">
                        <a href="profile.php?id=<?= e($user->id) ?>">
                            <img class="avatar-md" src="<?=  $user->avatar ? $user->avatar : get_avatar_url($user->email,60)   ?>"  alt="Image  de <?= e($user->pseudo) ?>" class="avatar img-circle"><br>
                            <h4 class="user-bloc-username">
                                <?= e($user->pseudo) ?>
                            </h4>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        <div id="pagination">
            <?= $pagination ?>
        </div>
    </div>
</div><!-- /.container -->
<?php include('partials/_footer.php');?>
