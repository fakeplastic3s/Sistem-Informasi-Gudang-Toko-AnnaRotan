<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('StokBarang'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"></h4>
        <form action="/StokBarang/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="supplier" class="col-sm-3 col-form-label">Id Supplier</label>
                <div class="col-sm-9">
                    <select name="supplier" class="select2_single form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>" value="<?= old('supplier'); ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($supplier as $row) : ?>
                            <option value="<?= $row['id_supplier']; ?>" <?php if (old('supplier') == $row['id_supplier']) echo 'selected'; ?>>
                                <?= $row['id_supplier']; ?> - <?= $row['nama_supplier']; ?> - <?= $row['nama_barang']; ?> -
                                Rp <?= number_format($row['harga_satuan'], 0, ",", "."); ?></option>

                        <?php endforeach; ?>
                    </select>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('supplier'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" autofocus value="<?= old('jumlah'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" autofocus value="<?= old('harga_jual'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('harga_jual'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="status" value="Diajukan">
            <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>