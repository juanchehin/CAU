$(document).ready(function() {
    $('#tick_descrip').summernote({
        height: 150
    });

    $.post("../../controller/categoria.php?op=combo", function(data, status) {
        console.log('data es : ', data);
        $('#cat_id').html(data);
    });

});

function init() {
    $("#ticket_form").on("submit", function(e) {
        guardaryeditar(e);
    });

}