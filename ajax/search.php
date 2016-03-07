<?php
    session_start();
    require '../config/database.php';
    require '../includes/functions.php';
    extract($_POST);

        $q = $db->prepare("SELECT id , pseudo , email , avatar , name  FROM users
                           WHERE (pseudo LIKE :query OR email LIKE :query OR avatar LIKE :query OR name LIKE :query)
                           LIMIT 5 ");
        $q->execute([
            'query' => '%'.$query.'%'
        ]);

        $users = $q->fetchAll(PDO::FETCH_OBJ);
        if(count($users)> 0){
            foreach($users AS $user){
                ?>
                <div class="display-box-user">
                    <a href="profile.php?id=<?= $user->id ?>">
                        <img src="<?= $user->avatar ? $user->avatar : get_avatar_url($user->email) ?>"
                             alt="<?= e($user->pseudo) ?>" class="img-circle avatar-xs">
                        &nbsp; <?= e($user->name) ?>
                        <br><?= e($user->email) ?></a>
                </div>
                <?php
            }
        }else{
            echo '<div class="display-box-user">Aucun utilisateur trouve</div>';
        }
?>