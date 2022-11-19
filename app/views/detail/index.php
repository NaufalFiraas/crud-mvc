<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card text-center mt-5 mb-5 shadow">
                <div class="card-header bg-dark bg-gradient text-white">
                    Detail Mahasiswa
                </div>
                <div class="card-body">
                    <img src="<?= BASEURL; ?>/img/<?= $data['detail']['foto']; ?>" alt="profile-picture" height="150" width="150">
                    <h5 class="card-title"><?= $data['detail']['nama']; ?></h5>
                    <p class="card-text">NRP: <?= $data['detail']['nrp']; ?></p>
                    <p class="card-text">Email: <?= $data['detail']['email']; ?></p>
                    <p class="card-text">Jurusan: <?= $data['detail']['jurusan']; ?></p>
                    <p class="card-text">Asal: <?= $data['detail']['asal']; ?></p>
                    <a href="<?= BASEURL; ?>" class="btn btn-success">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>