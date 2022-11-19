<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5 mb-5">
            <h2 class="text-center mb-3">Ubah Data User</h2>
            <?= Flasher::alert(); ?>
            <form action="<?= BASEURL; ?>/akun/ubahProfile" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fotoLama" value="<?= $data['userData']['foto']; ?>">
                <input type="hidden" name="id" value="<?= $data['userData']['id']; ?>">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input type="text" value="<?= $data['userData']['nama']; ?>" name="nama" class="form-control shadow-sm" id="nama" aria-describedby="namaHelp" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto:</label>
                    <input type="file" name="foto" class="form-control shadow-sm" id="foto" autocomplete="off">
                </div>
                <a href="<?= BASEURL; ?>/akun" class="btn btn-secondary shadow">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary shadow">Submit</button>
            </form>
        </div>
    </div>
</div>