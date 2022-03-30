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
                success: function(data) {
                    console.log(tahun);
                    window.location.reload();
                }
            });
        });
    });
</script>