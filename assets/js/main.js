/**
 * Created by ferry francois on 04/03/2016.
 */
$(document).ready(function(){
    $('[data-confirm]').on('click', function(e){
        e.preventDefault(); //Annuler l'action par défaut
        //Récupérer la valeur de l'attribut href
        var href = $(this).attr('href');
        //Récupérer la valeur de l'attribut data-confirm
        var message = $(this).data('confirm');
        //On aurait pu écrire aussi
        //var message = $(this).attr('data-confirm');
        //Afficher la popup SweetAlert
        swal({
            title: "Êtes-vous sûr?",
            text: message, //Utiliser la valeur de data-confirm comme text
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Annuler",
            confirmButtonText: "Oui",
            confirmButtonColor: "#DD6B55"
        }, function(isConfirm) {
          if(isConfirm) {
                //Si l'utilisateur clique sur Oui,
                //Il faudra le rediriger l'utilisateur vers la page
                //de suppression
                window.location.href = href;
            }
        });
    });
});