<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard Admin</a>
        / Kategori
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Kategori</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function getFirstWord($string)
                            {
                                $arr = explode(' ', trim($string));
                                return isset($arr[0]) ? $arr[0] : $string;
                            }
                            echo getFirstWord($usersession['nama']);
                            ?>
                </span>, selamat datang di dashboard Kategori</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-3">
    <h4 class="title__body__user me-3 mb-lg-4 mb-3">Daftar Kategori</h4>
    <a href="#staticBackdrop2" class="btn shadow-none btn__add btn__dark add__unit__icon mb-lg-4 mb-3" role="button"
        data-bs-toggle="modal">
        <i class="fa-solid fa-plus"></i>
        Add Kategori
    </a>
</div>

<!-- table Kategori -->
<div class="sipmpp__table">
    <div class="table-responsive">
        <table class="table table__kategori__content sipmpp__table-content table-hover">
            <thead class="bg__light">
                <tr>
                    <th class="table__user-number">no</th>
                    <th class="table__user-kategori">nama kategori</th>
                    <th class="table__user-aksi">aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($kategori as $k) : ?>
                <tr>
                    <td><?= $i; ?>
                    </td>
                    <td><?= $k['nama_kategori']; ?>
                    </td>
                    <td>
                        <a role="button" data-bs-toggle="modal" data-bs-placement="top" title="Edit"
                            href="#staticBackdrop" class="edit__data__induk__icon"
                            data-datakat="<?= $k['nama_kategori']; ?>"
                            data-dataidkat="<?= $k['kategori_id']; ?>"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
                <?php $i++;
                endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('modal'); ?>

<!-- Modal edit -->
<div class="modal fade edit__kategori__modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal__content">
            <div class="modal-header modal__header">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal__body">
                <h4 class="modal-title">Edit Kategori</h4>

                <!-- form -->
                <form class="modal__form" method="POST" action="/editdata/editkategori" id="formEditKategori">
                    <!-- id input -->
                    <input type="hidden" name="id" id="idEdit" />
                    <!-- unit -->
                    <div class="modal__form-content">
                        <label for="kategoriEdit" class="form-label form__label">Kategori <span
                                class="color__danger">*</span></label>
                        <input type="text" class="form-control shadow-none form__control" name="kategori"
                            id="kategoriEdit" required autocomplete="off" />
                    </div>
                    <!-- Button -->
                    <div class="modal__form-btn">
                        <button type="button" class="btn cancel__btn shadow-none" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn modal__btn shadow-none" id="btnEditKategori">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal add -->
<div class="modal fade add__kategori__modal" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdrop2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal__content">
            <div class="modal-header modal__header">
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal__body">
                <h4 class="modal-title">Add Kategori</h4>

                <!-- form -->
                <form class="modal__form" method="POST" action="/savedata/addkategori" id="formAddKategori">
                    <!-- id input -->
                    <input type="hidden" id="idAdd" />
                    <!-- unit -->
                    <div class="modal__form-content">
                        <label for="kategoriAdd" class="form-label form__label">Kategori <span
                                class="color__danger">*</span></label>
                        <input type="text" class="form-control shadow-none form__control" name="kategori"
                            id="kategoriAdd" required autocomplete="off" />
                    </div>
                    <!-- Button -->
                    <div class="modal__form-btn">
                        <button type="button" class="btn cancel__btn shadow-none" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn modal__btn shadow-none" id="btnAddKategori">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- jquery validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script>
    // tooltips
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon"
    );
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    // data trigger
    $(document).ready(() => {
        // get Edit Product
        $(".edit__data__induk__icon").on("click", function() {
            // get data from button edit
            const idKat = $(this).data("dataidkat");
            const kategoriKat = $(this).data("datakat");
            // Set data to Form Edit
            $("#idEdit").val(idKat);
            $("#kategoriEdit").val(kategoriKat);
            // Call Modal Edit
            $(".edit__kategori__modal").modal("show");
        });

        $(".add__unit__icon").on("click", function() {
            // Call Modal Edit
            $(".add__kategori__modal").modal("show");
        });
    });

    // validate form jquery
    const exclamationCircle = "<i class='fa-solid fa-circle-exclamation'></i>";

    $(document).ready(function() {
        $("#formAddKategori").validate({
            rules: {
                kategori: {
                    required: true,
                },
            },
            messages: {
                kategori: {
                    required: exclamationCircle + " Kategori is required.",
                },
            },
        });
        $("#formEditKategori").validate({
            rules: {
                kategori: {
                    required: true,
                },
            },
            messages: {
                kategori: {
                    required: exclamationCircle + " Kategori is required.",
                },
            },
        });

        $("#btnAddKategori").on("click", () => {
            console.log($("#formAddKategori").valid());
        });
        $("#btnEditKategori").on("click", () => {
            console.log($("#formEditKategori").valid());
        });
    });
</script>

<?= $this->endSection();
