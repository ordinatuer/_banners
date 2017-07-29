$(document).ready(function(){
    var views = {},
        $type = $('#Banners_type');
    views.image = function(){
        $('.contentRow').hide();
        $('.fileLabel').text('Image');
        $('.urlRow, .fileRow').show();
    }
    views.flash = function(){
        $('.urlRow, .contentRow').hide();
        $('.fileLabel').text('Flash');
        $('.fileRow').show();
    }
    views.html = function(){
        $('.urlRow, .fileRow').hide();
        $('.contentRow').show();
    }
    views.main = function(id){
        this[this.routes[id]]();
    }
    views.routes = {
        1 : 'image',
        2 : 'flash',
        3 : 'html'
    }
    views.main($type.val());
    $type.on('change', function(){
        views.main($(this).val());
    });
});