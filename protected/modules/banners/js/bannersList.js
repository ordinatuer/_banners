$(document).ready(function() {
    // ajax update CListView with filtr form submit
    $('#searchForm').on('submit', function(){
        $.fn.yiiListView.update('ajaxListView',{data:$(this).serialize()});
        return false;
    });
});