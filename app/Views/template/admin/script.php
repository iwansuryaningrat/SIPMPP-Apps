<script>
    // dropdown profile
    $(document).click((e) => {
        if (
            e.target.id !== "header-main-nav-dropdown" &&
            e.target.id !== "btn-dropdown" &&
            e.target.id !== "photo-dropdown" &&
            e.target.id !== "form-tahun-profile" &&
            e.target.id !== "form-tahun-profile-label" &&
            e.target.id !== "tahunProfile" &&
            e.target.id !== "profileEmail" &&
            e.target.id !== "profileName" &&
            e.target.id !== "profileStatus"
        ) {
            $("#header-main-nav-dropdown").removeClass("active");
        }
    });
    $("#btn-dropdown").click(() => {
        $("#header-main-nav-dropdown").toggleClass("active");
    });
    $("#photo-dropdown").click(() => {
        $("#header-main-nav-dropdown").toggleClass("active");
    });
    $("#profileName").click(() => {
        $("#header-main-nav-dropdown").toggleClass("active");
    });
    $("#profileEmail").click(() => {
        $("#header-main-nav-dropdown").toggleClass("active");
    });
    $("#profileStatus").click(() => {
        $("#header-main-nav-dropdown").toggleClass("active");
    });

    // switch tahun
    $(document).ready(function() {
        $("#tahunProfile").change(function() {
            var tahun = $(this).val();
            $.ajax({
                url: '/admin/switchtahun',
                type: 'POST',
                data: {
                    tahun: tahun
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });
    });

    // footer year now
    // get year now
    var currentYear = new Date().getFullYear();
    $("#footerYearNow").text(currentYear);
</script>