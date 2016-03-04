<article class="media status-media">
    <div class="pull-left">
        <img src="<?= $user->avatar ? $user->avatar : get_avatar_url($user->email,60) ?>" alt="Image de profil de <?= e($user->pseudo) ?>" class="media-object avatar-xs"><br>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?= e($user->pseudo); ?>
            <a data-confirm="Êtes-vous sûr de vouloir supprimer ce micropost ?"
               class="btn btn-info btn-xs" href="delete_micropost.php?id=<?= $micropost->id ?>">
                <i class="fa fa-trash"></i> Supprimer
            </a>
        </h4>

        <p>
            <i class="fa fa-clock-o"> &nbsp;<span class="timeago" title="
             <?= $micropost->created_at ?> "> <?= $micropost->created_at; ?> </span>
            </i>
        </p>
        <?= nl2br(replace_links(e($micropost->content)));  ?>
    </div>
</article>