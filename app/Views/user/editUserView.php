<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>


<a href="<?= base_url('DataAkun'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-left"></i></a>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Data Akun</h4>
        <form action="/User/update/<?= $user->user_id; ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Akun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" autofocus value="<?= $user->user_name; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('user_email')) ? 'is-invalid' : ''; ?>" id="user_email" name="user_email" oninvalid="this.setCustomValidity('Masukkan Email!')" oninput="this.setCustomValidity('')" value="<?= $user->user_email; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('user_email'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_password" class="col-sm-2 col-form-label">Password </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('user_password')) ? 'is-invalid' : ''; ?>" id="user_password" name="user_password" oninvalid="this.setCustomValidity('Masukkan Password!')" oninput="this.setCustomValidity('')" value="<?= $user->user_password; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('user_password'); ?>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_create_at" class="col-sm-2 col-form-label">Time </label>
                <div class="col-sm-10">
                    <input type="time" class="form-control <?= ($validation->hasError('usercreate_at')) ? 'is-invalid' : ''; ?>" id="user_create_at" name="user_create_at" oninvalid="this.setCustomValidity('Masukkan Waktu masuk data akun!')" oninput="this.setCustomValidity('')" value="<?= $user->user_create_at; ?>">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        <?= $validation->getError('user_create_at'); ?>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $user->user_id; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>