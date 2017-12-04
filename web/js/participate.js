var pageInitialized = false;
$(function(){
   if (pageInitialized) return;
    pageInitialized = true;
    var $container = $('div#naobundle_observation_photos');
    var index = 0;
    $('#add_photo').click(function(e){
        addPhoto($container);
        e.preventDefault();
        return false;
    })

    if (index === 0){
        addPhoto($container);
    }

    function addPhoto($container){
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Photo n°' + (index + 1))
            .replace(/__name__/g,        index)
        ;
        var $prototype = $(template);
        addDeleteLink($prototype);
        $container.append($prototype);
        index++;
    }

    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $prototype.append($deleteLink);
        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();
            return false;
        });
    }

    /*var index = $container.find(':input').length;
    $('#add_photo').click(function(e) {
        addPhoto($container);
        e.preventDefault();
        return false;
    });
    if (index === 0 ){
        addPhoto($container);
    } else {
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    function addPhoto($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Photo n°' + (index + 1))
            .replace(/__name__/g,        index)
        ;
        console.log(template);
        var $prototype = $(template);
        addDeleteLink($prototype);
        $container.append($prototype);
        index++;
    }
    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $prototype.append($deleteLink);
        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();
            return false;
        });
    }*/
});