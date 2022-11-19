<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
            <?= Flasher::alert(); ?>
            <div class="card text-center mt-2 mb-5 shadow">
                <div class="card-header bg-dark bg-gradient text-white">
                    Informasi Akun
                </div>
                <div class="card-body">
                    <img src="<?= BASEURL; ?>/img/<?= $data['userData']['foto']; ?>" alt="user-profile" height="150" width="150">
                    <h5 class="card-title"><?= $_SESSION['nama']; ?></h5>
                    <p class="card-text"><?= $data['userData']['level']; ?></p>
                    <a href="<?= BASEURL; ?>/akun/halamanUbah" class="btn btn-primary">Ubah Profile</a>
                    <a href="<?= BASEURL; ?>/akun/halamanUbahPassword" class="btn btn-success">Ubah Password</a>
                </div>
            </div>
        </div>
    </div>
</div>