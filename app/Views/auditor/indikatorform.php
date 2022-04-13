<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('auditor'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/">Audit <?= $data_user['unit']; ?></a>
    / <a href="/auditor/standar">Nilai SPMI</a> /
    <a
      href="/auditor/indikator/<?= $standar['standar_id'] . '/' . $datapenilaian['kategori_id'] ?>">Indikator</a>
    / Form Indikator
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Audit Penilaian Indikator SPMI</h1>
      <p>Menilai SPMI sesuai indikator</p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<h4 class="title__body__indikator-u">
  <!-- Unit: <span><?= $data_user['unit']; ?></span>
  -->
  Kategori: <?= $kategori; ?> <span><?= $data_user['tahun']; ?></span>
</h4>
<h4 class="title__body__indikator-s">
  <?= $standar['standar_id'] . '. ' . $standar['nama_standar']; ?>
</h4>

<!-- form indikator -->
<div class="mb-5"></div>
<div class="form__indikator">
  <form method="POST"
    action="/auditor/saveindikator/<?= $datapenilaian['indikator_id'] . '/' . $tahun . '/' . $datapenilaian['standar_id'] . '/' . $data_user['unit_id'] . '/' . $datapenilaian['kategori_id']; ?>"
    enctype="multipart/form-data">
    <!-- indikator -->
    <div class="row mb-3">
      <label for="indikator" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Indikator</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" id="indikator" name="indikator" cols="30" rows="3"
          disabled
          required><?= $datapenilaian['nama_indikator']; ?></textarea>
      </div>
    </div>
    <!-- target -->
    <div class="row mb-3">
      <label for="target" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Target</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" name="target" id="target" cols="30" rows="3" disabled
          required><?= $datapenilaian['target']; ?></textarea>
      </div>
    </div>
    <!-- kebutuhan data -->
    <div class="row mb-3 mb-sm-4">
      <label for="kebutuhan-data" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Kebutuhan Data</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" id="kebutuhan-data" name="kebutuhan-data" cols="30"
          rows="3" disabled
          required><?= $datapenilaian['nama_induk']; ?></textarea>
      </div>
    </div>
    <!-- satuan -->
    <div class="row mb-3 mb-sm-4">
      <label for="satuan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Satuan</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <input class="form-control form__control shadow-none" id="satuan" name="satuan" disabled required
          value="<?= $datapenilaian['satuan']; ?>" />
      </div>
    </div>
    <!-- Hasil -->
    <?php if ((int)$datapenilaian['nilai_acuan'] == 1) { ?>
    <div class="row mb-3">
      <label for="hasil" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Hasil</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <select class="form-select form__select shadow-none" name="hasil" id="hasil" disabled>
          <option selected disabled>Pilih hasil data</option>
          <option value="ADA / SESUAI">ADA / SESUAI</option>
          <option value="Tidak ADA / TIDAK SESUAI">Tidak ADA / TIDAK SESUAI</option>
        </select>
      </div>
    </div>
    <?php } elseif ((int)$datapenilaian['nilai_acuan'] > 1) { ?>
    <div class="row mb-3 mb-sm-4">
      <label for="hasil" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Hasil</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <input class="form-control form__control shadow-none" id="hasil" name="hasil" disabled />
      </div>
    </div>
    <?php } ?>

    <!-- dokumen -->
    <div class="row mb-3">
      <label for="dokumen" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Dokumen</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <div class="document__view">
          <div class="me-3">
            <div class="box__document">
              <div id="pdf-loader"><span>Loading Preview ...</span></div>
              <canvas id="pdf-preview" width="150"></canvas>
            </div>
          </div>
          <div class="info__document">
            <p id="pdf-name"></p>
            <a href="#" id="viewDocument">View Document</a>
          </div>
        </div>

        <!-- WOIII LAA COBAIN AJA DULU -->
        <div class="">
          <div id="preview-container">
            <button id="upload-dialog">Choose PDF</button>
            <input type="file" id="pdf-file" name="pdf" accept="application/pdf" />
            <!-- <canvas id="pdf-preview" width="150"></canvas> -->
            <!-- <span id="pdf-name"></span> -->
            <button id="upload-button">Upload</button>
            <button id="cancel-pdf">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- keterangan -->
    <div class="row mb-3">
      <label for="keterangan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Keterangan</label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" id="keterangan" cols="30" rows="3" name="keterangan"
          disabled></textarea>
      </div>
    </div>
    <!-- catatan -->
    <div class="row mb-3">
      <label for="catatan" class="col-lg-3 col-md-3 col-sm-4 col-form-label form__label">Catatan <span
          class="color__danger">*</span></label>
      <div class="col-lg-6 col-md-9 col-sm-8">
        <textarea class="form-control form__control shadow-none" name="catatan" id="catatan" cols="30" rows="3"
          required><?= $datapenilaian['catatan']; ?></textarea>
      </div>
    </div>
    <!-- button -->
    <div class="row">
      <div class="col-lg-9 col-md-12 col-sm-12 button__section">
        <a href="/auditor/indikator/<?= $standar['standar_id'] . '/' . $datapenilaian['kategori_id'] ?>"
          class="btn form__btn cancel__btn me-4 shadow-none" role="button">Batal</a>
        <button type="submit" class="btn form__btn btn__dark shadow-none">
          Simpan
        </button>
      </div>
    </div>
  </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="/auditor/js/pdf.js"></script>
<script src="/auditor/js/pdf.worker.js"></script>
<script>
  // tooltips
  // progress bar unit
  const tooltipsEdit = document.querySelectorAll(
    ".edit__data__induk__icon"
  );
  tooltipsEdit.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<!-- pdf preview image -->
<script>
  var _PDF_DOC,
    _CANVAS = document.querySelector('#pdf-preview'),
    _OBJECT_URL;

  function showPDF(pdf_url) {
    PDFJS.getDocument({
      url: pdf_url
    }).then(function(pdf_doc) {
      _PDF_DOC = pdf_doc;

      // Show the first page
      showPage(1);

      // destroy previous object url
      URL.revokeObjectURL(_OBJECT_URL);
    }).catch(function(error) {
      // trigger Cancel on error
      document.querySelector("#cancel-pdf").click();

      // error reason
      alert(error.message);
    });
  }

  function showPage(page_no) {
    // fetch the page
    _PDF_DOC.getPage(page_no).then(function(page) {
      // set the scale of viewport
      var scale_required = _CANVAS.width / page.getViewport(1).width;

      // get viewport of the page at required scale
      var viewport = page.getViewport(scale_required);

      // set canvas height
      _CANVAS.height = viewport.height;

      var renderContext = {
        canvasContext: _CANVAS.getContext('2d'),
        viewport: viewport
      };

      // render the page contents in the canvas
      page.render(renderContext).then(function() {
        document.querySelector("#pdf-preview").style.display = 'inline-block';
        document.querySelector("#pdf-loader").style.display = 'none';
      });
    });
  }


  /* Show Select File dialog */
  document.querySelector("#upload-dialog").addEventListener('click', function() {
    document.querySelector("#pdf-file").click();
  });

  /* Selected File has changed */
  document.querySelector("#pdf-file").addEventListener('change', function() {
    // user selected file
    var file = this.files[0];

    // allowed MIME types
    var mime_types = ['application/pdf'];

    // Validate whether PDF
    if (mime_types.indexOf(file.type) == -1) {
      alert('Error : Incorrect file type');
      return;
    }

    // validate file size
    if (file.size > 10 * 1024 * 1024) {
      alert('Error : Exceeded size 10MB');
      return;
    }

    // validation is successful

    // hide upload dialog button
    document.querySelector("#upload-dialog").style.display = 'none';

    // set name of the file
    document.querySelector("#pdf-name").innerText = file.name;
    document.querySelector("#pdf-name").style.display = 'block';

    // show cancel and upload buttons now
    document.querySelector("#cancel-pdf").style.display = 'inline-block';
    document.querySelector("#upload-button").style.display = 'inline-block';

    // Show the PDF preview loader
    document.querySelector("#pdf-loader").style.display = 'flex';

    // object url of PDF 
    _OBJECT_URL = URL.createObjectURL(file)

    // send the object url of the pdf to the PDF preview function
    showPDF(_OBJECT_URL);
  });

  /* Reset file input */
  document.querySelector("#cancel-pdf").addEventListener('click', function() {
    // show upload dialog button
    document.querySelector("#upload-dialog").style.display = 'inline-block';

    // reset to no selection
    document.querySelector("#pdf-file").value = '';

    // hide elements that are not required
    document.querySelector("#pdf-name").style.display = 'none';
    document.querySelector("#pdf-preview").style.display = 'none';
    document.querySelector("#pdf-loader").style.display = 'none';
    document.querySelector("#cancel-pdf").style.display = 'none';
    document.querySelector("#upload-button").style.display = 'none';
  });

  /* Upload file to server */
  document.querySelector("#upload-button").addEventListener('click', function() {
    // AJAX request to server
    alert('This will upload file to server');
  });
</script>

<?= $this->endSection();
