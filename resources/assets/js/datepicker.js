$(document).ready(function () {
    // $('.dropdown-submenu a.submenu').on("click", function(e){
    //     $(this).next('ul').toggle();
    //     e.stopPropagation();
    //     e.preventDefault();
    // });

    if ($("#start_date").length) {
        $( "#start_date" ).datepicker({
            title: "Start Date",
            format: "yyyy-mm-dd",
            startDate: new Date(),
            autoclose: true,
            zIndexOffset: 1000,
            ignoreReadonly: true
        });

        $( "#end_date" ).click(function () {
            if ($( "#start_date" ).datepicker("getDate") === null) {
                $(this).attr("placeholder", "Fill in start date first...");
            }
        });

        if ($( "#start_date" ).datepicker("getDate") != null) {
            var date = $("#start_date").datepicker("getDate");
            date.setDate(date.getDate() + 1);
            $( "#end_date" ).datepicker({
                title: "End Date",
                format: "yyyy-mm-dd",
                startDate: date,
                autoclose: true,
                zIndexOffset: 1000,
                ignoreReadonly: true
            });
        }

        $("#start_date").on("changeDate", function(e) {
            $("#end_date").attr("placeholder", "End date...");
            $( "#end_date" ).datepicker("destroy");
            var date = $(this).datepicker("getDate");
            date.setDate(date.getDate() + 1);
            $( "#end_date" ).datepicker({
                title: "End Date",
                format: "yyyy-mm-dd",
                startDate: date,
                autoclose: true,
                zIndexOffset: 1000,
                ignoreReadonly: true
            });
            $( "#end_date" ).focus();
        });
    }

    if ($("#start_date_readonly").length) {
        var date = new Date($("#start_date_readonly").val())
        date.setDate(date.getDate() + 1);
        $( "#end_date" ).datepicker({
            title: "End Date",
            format: "yyyy-mm-dd",
            startDate: date,
            autoclose: true,
            zIndexOffset: 1000,
            ignoreReadonly: true
        });
    }

    $("#start_date_calender").click(function () {
        $( "#start_date" ).focus();
    });

    $("#end_date_calender").click(function () {
        $( "#end_date" ).focus();
        if ($( "#start_date" ).datepicker("getDate") === null) {
            $("#end_date").attr("placeholder", "Fill in start date first...");
        }
    });
});