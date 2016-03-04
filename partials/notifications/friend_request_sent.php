<a href="profile.php?id=<?= $notification->user_id ?>">
     <img src="<?= $notification->avatar ? $notification->avatar : get_avatar_url($notification->email, 40) ?>
     " alt="Image de profil de <?= e($notification->pseudo) ?>" class="avatar-xs">
     <?= e($notification->pseudo) ?>
     </a>
 vous a envoyé une demande d'amitié &nbsp;&nbsp; <span class="timeago" title="<?= $notification->created_at ?>">
    <?= $notification->created_at ?></span>.&nbsp;&nbsp;&nbsp;&nbsp;

<div class="pull-right">
    <a class="btn btn-primary btn-xs" href="accept_friend_resquest.php?id=<?= $notification->user_id ?>">Accepter</a>
    <a class="btn btn-danger btn-xs" href="delete_friend.php?id=<?= $notification->user_id ?>">Decliner</a>
</div>