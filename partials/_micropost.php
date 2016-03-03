<article class="media status-media">
    <div class="pull-left">
        <img src="<?= $user->avatar ? $user->avatar : get_avatar_url($user->email,60) ?>" alt="Image de profil de <?= e($user->pseudo) ?>" class="media-object avatar-xs"><br>
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?= e($user->pseudo); ?></h4>
        <p>
            <i class="fa fa-clock-o"> &nbsp;<span class="timeago" title=" <?= $micropost->created_at ?> "> <?= $micropost->created_at; ?> </span>
            </i>
        </p>
        <?= nl2br(replace_links(e($micropost->content))); ?>
    </div>
</article>