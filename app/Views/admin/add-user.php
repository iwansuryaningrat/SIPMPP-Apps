<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / <a href="/admin/daftarUser">Daftar User</a> / Form Add User
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Add User</h1>
            <p>
                Form untuk menambahkan user baru
            </p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add">
    <h4 class="title__body__user">Form Add User</h4>
</div>

<!-- form add user -->
<div class="form__add__user">
    <!-- Menampilkan flashdata -->
    <?= session()->getFlashdata('msg'); ?>
    <form method="POST" action="/savedata/adduser" id="formAddUser">
        <!-- fullname -->
        <div class="row mb-3 mb-sm-4">
            <label for="fullname" class="col-lg-3 col-md-4 col-sm-4 col-form-label form__label">Nama Lengkap
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-8 col-sm-8">
                <input class="form-control form__control shadow-none" id="fullname" name="fullname" required
                    autocomplete="off" placeholder="Masukkan nama lengkap" />
            </div>
        </div>
        <!-- email -->
        <div class="row mb-3 mb-sm-4">
            <label for="email" class="col-lg-3 col-md-4 col-sm-4 col-form-label form__label">Email
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-8 col-sm-8">
                <input class="form-control form__control shadow-none" id="email" name="email" required
                    autocomplete="off" placeholder="Masukkan email" />
            </div>
        </div>
        <!-- password -->
        <div class="row mb-3 mb-sm-4">
            <label for="password" class="col-lg-3 col-md-4 col-sm-4 col-form-label form__label">Password
                <span class="color__danger">*</span></label>
            <div class="col-lg-6 col-md-8 col-sm-8 position-relative">
                <input class="form-control form__control shadow-none" type="password" id="password" name="password"
                    required autocomplete="off" placeholder="Masukkan password" />
                <span id="togglePassword"><i class="fa-solid fa-eye icon__hide__password"
                        title="show password"></i></span>
            </div>
        </div>
        <!-- button -->
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 button__section">
                <a href="/admin/daftarUser" class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
                <button type="submit" class="btn form__btn btn__dark shadow-none" id="btnAddUser">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
    // validate form jquery
    const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";

    $(document).ready(function() {
        $("#formAddUser").validate({
            rules: {
                fullname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
            },
            messages: {
                fullname: {
                    required: exclamationCircle + " Nama lengkap is required.",
                },
                email: {
                    required: exclamationCircle + " Email is required.",
                    email: exclamationCircle + " A valid email address is required.",
                },
                password: {
                    required: exclamationCircle + " Password is required.",
                    minlength: exclamationCircle + " Password must have at least 8 characters.",
                },
            },
        });

        $("#btnAddUser").on("click", () => {
            console.log($("#formAddUser").valid());
        });
    });

    // togglePassword
    // change icon
    $("#togglePassword").click(function() {
        $(this).children().toggleClass("fa-eye-slash");
        $(this).children().toggleClass("fa-eye");

        var type = $("#password").attr("type") === "password" ? "text" : "password";
        $("#password").attr("type", type);

    });
</script>

<?= $this->endSection();
