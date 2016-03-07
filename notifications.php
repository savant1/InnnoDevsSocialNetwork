<?php
 session_start();
 require("includes/init.php");
 include('filters/auth_filters.php');

    $q = $db->prepare(
         "SELECT notifications.id FROM notifications
          LEFT JOIN users ON users.id = user_id
          WHERE subject_id = ?
     ");
    $q->execute([get_session('user_id')]);

    $notifications_total = $q->rowCount();

     if($notifications_total >= 1){

         $nbre_notifications_par_page = 10;

         $nbre_pages_max_gauche_et_droite = 4;

         $last_page = ceil($notifications_total / $nbre_notifications_par_page);

         if(isset($_GET['page']) && is_numeric($_GET['page'])){
                $page_num = $_GET['page'];
         } else {
                 $page_num = 1;
         }

    if($page_num < 1){
             $page_num = 1;
         } else if($page_num > $last_page) {
                 $page_num = $last_page;
         }

            $limit = 'LIMIT '.($page_num - 1) * $nbre_notifications_par_page. ',' . $nbre_notifications_par_page;

            $q = $db->prepare(
                "SELECT users.pseudo, users.avatar, users.email,
                     notifications.subject_id, notifications.name,
                     notifications.user_id, notifications.seen,
                     notifications.created_at
                     FROM notifications
                     LEFT JOIN users ON users.id = user_id
                     WHERE subject_id = ?
                     ORDER BY notifications.created_at DESC
                     $limit
            ");
            $q->execute([get_session('user_id')]);

     $notifications = $q->fetchAll(PDO::FETCH_OBJ);


            $pagination = '<nav class="text-center"><ul class="pagination">';

        if($last_page != 1){
            if($page_num > 1){
                $previous = $page_num - 1;
                $pagination .= '<li><a href="notifications.php?page='.$previous.'" aria-label="'. $menu['precedent'][$_SESSION['locale']].'"><span aria-hidden="true">&laquo;</span></a></li>';

                for($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++){
                        if($i > 0){
                            $pagination .= '<li><a href="notifications.php?page='.$i.'">'.$i.'</a></li>';
                        }
                }
            }

            $pagination .= '<li class="active"><a href="#">'.$page_num.'</a></li>';

            for($i = $page_num+1; $i <= $last_page; $i++){
                 $pagination .= '<li><a href="notifications.php?page='.$i.'">'.$i.'</a></li>';
                    if($i >= $page_num + $nbre_pages_max_gauche_et_droite){
                      break;
                    }
            }

            if($page_num != $last_page){
                 $next = $page_num + 1;
                $pagination .= '<li><a href="notifications.php?page='.$next.'"aria-label="'. $menu['suivant'][$_SESSION['locale']].'"><span aria-hidden="true">&raquo;</span></a></li>';
            }
        }

            $pagination .= '</ul></nav>';

            require("views/notifications.views.php");
     } else {
         set_flash( $menu['no_notif'][$_SESSION['locale']] );
     redirect('index.php');
     }

 $q = $db->prepare("UPDATE notifications SET seen = '1' WHERE subject_id = ?");
$q->execute([get_session('user_id')]);