$(document).ready(function(){
    var $field = $('.autoAction'),
        $ul    = $('.autoList');

    $field.on('keyup', function() {
        $.ajax({
            dataType:'json',
            url:'/banners/bannerShow/autocomplete?controller='+$field.val(),
            success:function(res) {
                $ul.show();
                completeStrings(res);
            }
        });
    });
    function completeStrings(res) {
        $ul.html('');
        $.each(res, function() {
            $ul.append($('<li/>', {text:this}));
        });
    }

    $ul.on('click', 'li', function() {
        $field.val($(this).text());
        $ul.hide();
    });
    $ul.on('hover', 'li', function() {
        $field.val($(this).text());
    });

    $('*').on('click',function() {
        $ul.hide();
    });
});