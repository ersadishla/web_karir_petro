<script>
    $(document).on('click', '.allow-focus', function (e) {
        e.stopPropagation();
    });
</script>

<script>
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>

<script>
    $(document).ready(function($) {
        $('.date-picker').datepicker({
            autoclose: true,
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy',
        });
    });
</script>

<!-- File Upload -->
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>