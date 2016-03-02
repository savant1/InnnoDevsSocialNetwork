<?php
        if(isset($errors) && count($errors) != 0){
            echo '
               <div class="alert alert-danger">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>';

                    foreach($errors AS $error){
                        echo $error .'<br>';
                    }
             echo  '</div>';
        }