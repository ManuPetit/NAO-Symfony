$(document).ready(function () {
    //recuperer id du div du prototype
    var $container = $('.js-form-image-wrapper');

    //compteur unique pour nommer les champs
    var index = $container.attr('data-index');

    //ajouter un champ de upload à chaque clicl
    $('#js-add-image').click(function(e){
        addFileUpload($container);
        e.preventDefault();
        return false;
    });

    // //on vérifie s'il y a déjà un champs, sinon on en ajoute un
    // if (index == 0){
    //     addFileUpload($container)
    // }

    //on enlève l'image en question
    $('.js-form-image-wrapper').on('click', '.js-remove-image', function(){
        $(this).closest('.js-image-item').remove();
        return false;
    });

    //ajout bloc image loading
    function addFileUpload($container)
    {
        //remplace les textes dans le prototype avec les numéros d'index
        var template = $container.attr('data-prototype')
            .replace(/__name__/g, index);
        //creation d'un objet avec le template
        var $prototype = $(template);
        //ajout du prototype sur la balise
        $container.append($prototype);
        //incrémentation de l'index
        index++;
    }

});