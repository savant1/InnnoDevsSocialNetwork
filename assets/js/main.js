$(document).ready(function(){

    //script pour les recherches
    var url = 'ajax/search.php'
    jQuery('#searchbox').on('keyup',function(){
        var query = $(this).val();
        if(query.length > 0){
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    query: query
                },
                beforeSend: function(){
                    $('#spinner').show();
                },
                success: function(data){
                    $('#display-result').html(data).show();
                    $('#spinner').hide();
                }
            });
        }else{
            $('#display-result').hide();
        }
    });

    //script pour les suppressions de microposts
    $('[data-confirm]').on('click', function(e){
        e.preventDefault(); //Annuler l'action par défaut
        //Récupérer la valeur de l'attribut href
        var href = $(this).attr('href');
        //Récupérer la valeur de l'attribut data-confirm
        var message = $(this).data('confirm');
        //On aurait pu écrire aussi
        //var message = $(this).attr('data-confirm');
        //Afficher la popup SweetAlert
        //swal({
        //    title: "Êtes-vous sûr?",
        //    text: message, //Utiliser la valeur de data-confirm comme text
        //    type: "warning",
        //    showCancelButton: true,
        //    cancelButtonText: "Annuler",
        //    confirmButtonText: "Oui",
        //    confirmButtonColor: "#DD6B55"
        //}, function(isConfirm) {
        //  if(isConfirm) {
        //        //Si l'utilisateur clique sur Oui,
        //        //Il faudra le rediriger l'utilisateur vers la page
        //        //de suppression
        //        window.location.href = href;
        //    }
        //});

        swal({
                title: "Êtes-vous sûr?",
                text: message,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: "Annuler",
                confirmButtonText: "Oui",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    swal("Supprimé!", "Votre micropost a été supprimé.", "success");
                    window.location.href = href;
                } else {
                    swal("Annulé", "Votre micropost n'a pas été supprimé :)", "error");
                }
            });

    });
});