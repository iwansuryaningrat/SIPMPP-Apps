<script>
    // dropdown profile
    $(document).click((e) => {
        if (
            e.target.id !== "header-main-nav-dropdown" &&
            e.target.id !== "btn-dropdown" &&
            e.target.id !== "photo-dropdown" &&
            e.target.id !== "form-tahun-profile" &&
            e.target.id !== "form-tahun-profile-label" &&
            e.target.id !== "form-unit-profile-label" &&
            e.target.id !== "tahunProfile" &&
            e.target.id !== "unitProfile" &&
            e.target.id !== "profileEmail" &&
            e.target.id !== "profileName" &&
            e.target.id !== "profileStatus" &&
            e.target.id !== "btnFilterLeader" &&
            e.target.id !== "filterLeader" &&
            e.target.id !== "btnFilterLeaderIcon" &&
            e.target.id !== "btnFilterLeaderSpan" &&
            e.target.id !== "tahunLeader" &&
            e.target.id !== "unitLeader" &&
            e.target.id !== "filterLeaderContainer" &&
            e.target.id !== "formFilterLeader"
        ) {
            $("#header-main-nav-dropdown").removeClass("active");
            $("#filterLeader").removeClass("active");
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
    $("#btnFilterLeader").click(() => {
        $("#filterLeader").toggleClass("active");
    });
    $("#btnFilterLeaderIcon").click(() => {
        $("#filterLeader").toggleClass("active");
    });
    $("#btnFilterLeaderSpan").click(() => {
        $("#filterLeader").toggleClass("active");
    });

    // switch tahun
    $(document).ready(function() {
        $("#tahunProfile").change(function() {
            var tahun = $(this).val();
            $.ajax({
                url: '/leader/switchtahun',
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
    $("#sidebarfooterYearNow").text(currentYear);
</script>