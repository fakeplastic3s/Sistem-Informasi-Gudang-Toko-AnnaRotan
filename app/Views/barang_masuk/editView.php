<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('BarangMasuk'); ?>" class="btn btn-secondary mb-3"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"></h4>
        <form action="/BarangMasuk/update/<?= $barangmasuk->id_barang_masuk; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="supplier" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-10">
                    <select name="supplier" class="select2_single form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>" value="<?= old('supplier'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($supplier as $row) : ?>
                            <option value="<?= $row['id_supplier']; ?>" <?php if ($row['id_supplier'] == $barangmasuk->id_supplier) echo 'selected'; ?>><?= $row['nama_barang']; ?> - <?= $row['nama_supplier']; ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('supplier'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="pengadaan" class="col-sm-2 col-form-label">Jumlah Pengadaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" value=" <?= $barangmasuk->jumlah_masuk; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= $barangmasuk->tgl_masuk; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('tanggal'); ?>
                    </div>
                </div>
            </div>

            <input type="hidden" name="pengadaan" value="<?= $barangmasuk->id_pengadaan; ?>">
            <input type="hidden" name="id" value="<?= $barangmasuk->id_barang_masuk; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>