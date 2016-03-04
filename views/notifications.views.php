<?php $title = "Notifications"; ?>
<?php include ('partials/_header.php');?>

<div id="main-content">
     <div class="container">
         <h1 class="lead">Vos notifications</h1>

        <?php if(count($notifications) > 0): ?>
             <ul class="list-group">
                 <?php foreach($notifications as $notification): ?>
                      <li class="list-group-item <?= $notification->seen == '0' ? 'not_seen' : '' ?>">
                          <?php require("partials/notifications/{$notification->name}.php"); ?>
                      </li>
                 <?php endforeach; ?>
             </ul>
            <div id="pagination"><?= $pagination ?></div>
        <?php else: ?>
             <p>Aucune notification disponible pour l'instant.</p>
             <?php endif; ?>
     </div>
</div>

<!-- SCRIPTS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.livequery.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/jquery.timeago.fr.js"></script>
 <script type="text/javascript">
     jQuery(document).ready(function() {
         $(".timeago").timeago();
     });
//     $(document).ready(function() {
//         $("span.timeago").timeago();
//     });
//     $('span.timeago')
//         .livequery(function(){
//             $("span.timeago").timeago();
//         });
     </script>
 </body>
</html>