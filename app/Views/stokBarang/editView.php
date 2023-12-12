<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<a href="<?= base_url('StokBarang'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><?= $title; ?></h4>
        <form action="/StokBarang/update/<?= $StokBarang->id_stok; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="supplier" class="col-sm-2 col-form-label">Id Supplier</label>
                <div class="col-sm-10">
                    <select name="supplier" class="select2_single form-control <?= ($validation->hasError('supplier')) ? 'is-invalid' : ''; ?>" value="<?= $StokBarang->id_supplier; ?>">
                        <option value="">--Pilih--</option>
                        <?php foreach ($supplier as $row) : ?>
                            <option value="<?= $row['id_supplier']; ?>" <?php if ($row['id_supplier'] == $StokBarang->id_supplier) echo 'selected'; ?>>
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
                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $StokBarang->jumlah; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('jumlah'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?>" id="harga_jual" name="harga_jual" value="<?= $StokBarang->harga_jual; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('harga_jual'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $StokBarang->id_stok; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>