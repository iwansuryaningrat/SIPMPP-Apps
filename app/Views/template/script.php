<script>
    $(document).ready(function() {
        $("#tahunProfile").change(function() {
            var tahun = $(this).val();
            $.ajax({
                url: '/home/switchtahun',
                type: 'POST',
                data: {
                    tahun: tahun
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });
        });
    });
</script>