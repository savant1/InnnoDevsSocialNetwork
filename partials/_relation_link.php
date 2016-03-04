<?php if(relation_link_to_display($_GET['id']) == CANCEL_RELATION_LINK ): ?>
    <a href="#" class="btn btn-info pull-right btn-xs">
        <i class="fa fa-user"></i> Une demande d'ami a deja ete envoye </a> <br>
    <br>
    <a class="btn btn-info pull-right btn-xs" href="delete_freind.php?id=<?= $_GET['id']; ?>" class="btn btn-danger pull-right">
        <i class="fa fa-minus"></i> Supprimer la demande!!! </a>

<?php elseif(relation_link_to_display($_GET['id']) == ACCEPT_REJECT_RELATION_LINK ): ?>
    <a class="btn btn-info  btn-xs" href="accept_friend_resquest.php?id=<?= $_GET['id']; ?>">Accepter la demande</a>
    <a class="btn btn-danger  btn-xs" href="delete_freind.php?id=<?= $_GET['id']; ?>">Decliner la demande</a>

<?php elseif(relation_link_to_display($_GET['id']) == DELETE_RELATION_LINK ): ?>

    Vous etes deja ami
    <a class="btn btn-warning pull-right btn-xs" href="delete_freind.php?id=<?= $_GET['id']; ?>">Retirer de ma liste d'ami</a>

<?php elseif(relation_link_to_display($_GET['id']) == ADD_RELATION_LINK ) : ?>
    <a href="add_freind.php?id=<?= $_GET['id']; ?>" class="btn btn-info pull-right btn-xs">
        <i class="fa fa-plus"></i> Ajouter A Mes Amis</a>

<?php endif;?>