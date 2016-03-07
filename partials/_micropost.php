<article class="media status-media" id="micropost<?= $micropost->m_id ?>">
     <div class="pull-left">
         <img src="<?= $micropost->avatar ? $micropost->avatar: get_avatar_url($micropost->email,60) ?>"
              alt="<?= $micropost->pseudo ?>" class="media-object avatar-xs">
     </div>
     <div class="media-body">
         <h4 class="media-heading"><?= e($micropost->pseudo); ?></h4>
         <p>
             <i class="fa fa-clock-o"></i>
             <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span>
             <?php if($micropost->user_id == get_session('user_id')): ?>
                 <a
                 data-confirm="Voulez-vous vraiment supprimer cette publication ?"
                  href="delete_micropost.php?id=<?= $micropost->m_id ?>">
                     <i class="fa fa-trash"></i>
                     Supprimer
                 </a>
             <?php endif; ?>
         </p>
         <?= nl2br(replace_links(e($micropost->content))); ?>

         <hr>
         <p>
             <?php if(user_has_already_like_the_micropost($micropost->m_id)): ?>
                 <a id="unlike<?= $micropost->m_id ?>" data-action="unlike"
                    class="like btn btn-info btn-xs" href="unlike_micropost.php?id=<?= $micropost->m_id ?>">
                     <i class="fa fa-heart"></i> Je n'aime plus</a>
             <?php else: ?>
                 <a id="like<?= $micropost->m_id ?>" data-action="like"
                    class="like btn btn-info btn-xs" href="like_micropost.php?id=<?= $micropost->m_id ?>">
                     <i class="fa fa-heart"></i> J'aime</a>
             <?php endif; ?>
             <div id="likers_<?= $micropost->m_id ?>">
<!--                    <a href="">ferry1</a> <a href="">savant1</a> <a href="">savant15</a> aiment cette publication-->
                <?= get_likers_text($micropost->m_id) ?>
            </div>
         </p>
     </div>
</article>