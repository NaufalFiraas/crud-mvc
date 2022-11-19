<div class="container mt-4">
    <h2 class="text-center mb-4">DAFTAR MAHASISWA</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <?php if ($_SESSION['level'] == 'admin') : ?>
                <button type="button" id="tambahData" class="btn btn-primary mb-2 mt-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data Mahasiswa</button>
            <?php endif; ?>
            <?= Flasher::flash(); ?>
            <ul class="list-group shadow mb-3" id="mahasiswaUl">
                <?php foreach ($data['mhs'] as $mhs) : ?>
                    <li class="list-group-item d-flex flex-md-row flex-column justify-content-md-between align-items-center">
                        <span class="text-center"><?= $mhs['nama']; ?></span>
                        <span class="text-center"><?= $mhs['jurusan']; ?></span>
                        <div class="badges">
                            <?php if ($_SESSION['level'] == 'admin') : ?>
                                <a href="<?= BASEURL; ?>/detail/index/<?= $mhs['id']; ?>" class="badge text-bg-primary me-1 text-decoration-none">detail</a>
                                <a href="<?= BASEURL; ?>/ubah/index/<?= $mhs['id']; ?>" class="badge text-bg-success me-1 text-decoration-none ubahData">ubah</a>
                                <a href="#" onclick="showAlert('Hapus Data', 'Yakin hapus data mahasiswa?', 'warning', `<?= BASEURL; ?>/home/hapus/<?= $mhs['id']; ?>`)" class="badge text-bg-danger text-decoration-none tombolHapus">hapus</a>
                            <?php else : ?>
                                <a href="<?= BASEURL; ?>/detail/index/<?= $mhs['id']; ?>" class="badge text-bg-success me-1 text-decoration-none">detail</a>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

</div>

<!-- modal tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Tambah Data Mahasiswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>/home/tambah" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <label for="nama">Nama:</label>
                    <input class="form-control mb-2" type="text" id="nama" name="nama" autocomplete="off" required autofocus>
                    <label for="nrp">NRP:</label>
                    <input class="form-control mb-2" type="number" id="nrp" name="nrp" autocomplete="off" required autofocus>
                    <label for="email">Email:</label>
                    <input class="form-control mb-2" type="email" id="email" name="email" autocomplete="off" required autofocus>
                    <label for="jurusan">Jurusan:</label>
                    <input class="form-control mb-2" type="text" id="jurusan" name="jurusan" autocomplete="off" required autofocus>
                    <label for="asal">Asal Kota:</label>
                    <input class="form-control mb-2" type="text" id="asal" name="asal" autocomplete="off" required autofocus>
                    <label for="foto">Foto:</label>
                    <input class="form-control mb-2" type="file" id="foto" name="foto" autocomplete="off" required autofocus>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" id="modalSubmit" name="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>