$(document).ready(function() {
    $('#tableID').DataTable({ });

    $("#btn").click(function(){
        $(".create").fadeToggle(1000);
    });
});