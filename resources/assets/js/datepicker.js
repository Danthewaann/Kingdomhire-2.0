$(document).ready(function () {
    $('.dropdown-submenu a.submenu').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });
    $( "#start_date" ).datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true,
        zIndexOffset: 1000,
        ignoreReadonly: true
    });
    $("#start_date_calender").click(function () {
        $( "#start_date" ).focus();
    });
    $( "#end_date" ).datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true,
        zIndexOffset: 1000,
        ignoreReadonly: true
    });
    $("#end_date_calender").click(function () {
        $( "#end_date" ).focus();
    });
});

// $(function () {
//     $('[data-toggle="popover"]').popover();
// });