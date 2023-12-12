<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<a href="<?= base_url('DataAkun'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Tambah Data Akun</h4>
        <form action="/DataAkun/add" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="user_name" class="col-sm-2 col-form-label">Nama Akun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('user_name')) ? 'is-invalid' : ''; ?>" id="user_name" name="user_name" autofocus value="<?= old('user_name'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('user_name'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('user_email')) ? 'is-invalid' : ''; ?>" id="user_email" name="user_email" value="<?= old('user_email'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('user_email'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control <?= ($validation->hasError('user_password')) ? 'is-invalid' : ''; ?>" id="user_password" name="user_password" value="<?= old('user_password'); ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('user_password'); ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data Akun</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>