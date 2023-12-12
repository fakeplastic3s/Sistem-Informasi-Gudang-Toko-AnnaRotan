<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<section class="section dashboard">
    <?php if (session()->getFlashdata('pesan_tambah')) : ?>
        <div class="alert alert-success my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_tambah'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_hapus')) : ?>
        <div class="alert alert-danger my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_hapus'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('pesan_edit')) : ?>
        <div class="alert alert-primary my-2 text-center" role="alert">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('pesan_edit'); ?>
        </div>
    <?php endif; ?>


    <div class="card pt-4">
        <div class="card-body">
            <div class="row ">
                <div class="col-lg-7 col-sm-4 col-md-5 ms-2">
                    <a href="<?= base_url('DataAkun/tambahuser'); ?>" class="btn btn-success mb-2"><i class="bi bi-clipboard-plus"></i> Tambah Data</a>
                    <!-- <button onclick="window.print()" class="btn btn-primary mb-2"><i class="ri-printer-line"></i></button>
                    <a href="<?= base_url('DataAkun'); ?>" class="btn btn-secondary mb-2"><i class="bi bi-arrow-clockwise"></i></a> -->
                </div>
                <!-- <div class="col me-2 pb-3">

                    <form class="d-flex" role="search" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search" name="cari">
                        <button class="btn btn-outline-success cari" type="submit">Search</button>
                    </form>
                </div> -->
            </div>
            <!-- <h5 class="card-title">Table with stripped rows</h5> -->
            <!-- Table with stripped rows -->

            <div class="table-responsive-md">
                <table class="table table-striped text-center datatable">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Nama Akun</th>
                            <th scope="col">Email</th>
                            <th scope="col">Time</th>
                            <th scope="col" class="aksi">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($getUser as $isi) : ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td class="text-right"><?= $isi['user_name']; ?></td>
                                <td class="text-center"><?= $isi['user_email']; ?></td>
                                <td class="text-center"><?= $isi['user_create_at']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('DataAkun/hapus/' . $isi['user_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?');"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with stripped rows -->

        </div>
    </div>
</section>
<?= $this->endSection(); ?>