$(document).ready(function() {
    $('.services').hover(function(e) {
        $(e.target).find('.hidden-info').show('slow');
    }, function(e) {
        $(e.target).find('.hidden-info').hide('slow');
    });
});
