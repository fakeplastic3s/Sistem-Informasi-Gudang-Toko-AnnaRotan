<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('BarangMasuk'); ?>" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"></h4>
        <form action="/BarangMasuk/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="supplier" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                    <select name="supplier" class="select2_single form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>" value="<?= old('supplier'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($pengadaan as $row) : ?>
                            <option value="<?= $row['id_supplier']; ?>" <?php if (old('supplier') == $row['id_supplier']) echo 'selected'; ?>><?= $row['nama_barang']; ?> - <?= $row['nama_supplier']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('supplier'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="pengadaan" class="col-sm-3 col-form-label">ID Pengadaan</label>
                <div class="col-sm-9">
                    <select name="pengadaan" class="select2_single form-control <?= ($validation->hasError('pengadaan')) ? 'is-invalid' : ''; ?>" value="<?= old('pengadaan'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($pengadaan as $row) : ?>
                            <option value="<?= $row['id_pengadaan']; ?>" <?php if (old('pengadaan') == $row['id_pengadaan']) echo 'selected'; ?>>Pengadaan <?= $row['nama_barang']; ?> (Jumlah : <?= $row['jumlah']; ?>)</option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('pengadaan'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="jumlah" class="col-sm-3 col-form-label">Jumlah Barang Masuk</label>
                <div class="col-sm-9">
                    <select name="jumlah" class="select2_single form-control <?= ($validation->hasError('pengadaan')) ? 'is-invalid' : ''; ?>" value="<?= old('jumlah'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($pengadaan as $row) : ?>
                            <option value="<?= $row['jumlah']; ?>" <?php if (old('jumlah') == $row['jumlah']) echo 'selected'; ?>> <?= $row['jumlah']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" autofocus value="<?= old('tanggal'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>