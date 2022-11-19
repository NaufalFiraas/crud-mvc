<div class="container">
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-5">
            <h2 class="text-center mb-3">Ubah Data Mahasiswa</h2>
            <form action="<?= BASEURL; ?>/ubah/ubahData" method="post" enctype="multipart/form-data">
                <input type="hidden" value="<?= $data['detail']['id']; ?>" name="id">
                <input type="hidden" value="<?= $data['detail']['foto']; ?>" name="fotoLama">
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama: </label>
                    <input type="text" class="form-control shadow-sm" value="<?= $data['detail']['nama']; ?>" name="nama" id="nama" required autocomplete="off" autofocus>
                </div>
                <div class="mb-2">
                    <label for="nrp" class="form-label">NRP: </label>
                    <input type="text" class="form-control shadow-sm" value="<?= $data['detail']['nrp']; ?>" name="nrp" id="nrp" required autocomplete="off">
                </div>
                <div class="mb-2">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" class="form-control shadow-sm" value="<?= $data['detail']['email']; ?>" name="email" id="email" required autocomplete="off">
                </div>
                <div class="mb-2">
                    <label for="jurusan" class="form-label">Jurusan: </label>
                    <input type="text" class="form-control shadow-sm" value="<?= $data['detail']['jurusan']; ?>" name="jurusan" id="jurusan" required autocomplete="off">
                </div>
                <div class="mb-2">
                    <label for="asal" class="form-label">Kota Asal:</label>
                    <input type="text" class="form-control shadow-sm" value="<?= $data['detail']['asal']; ?>" name="asal" id="asal" required autocomplete="off">
                </div>
                <div class="mb-2">
                    <label for="foto" class="form-label">Foto: </label>
                    <input type="file" class="form-control shadow-sm" value="<?= $data['detail']['foto']; ?>" name="foto" id="foto">
                </div>
                <a href="<?= BASEURL; ?>" class="btn btn-secondary mt-2 shadow" type="button">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary mt-2 shadow">Ubah</button>
            </form>
        </div>
    </div>
</div>