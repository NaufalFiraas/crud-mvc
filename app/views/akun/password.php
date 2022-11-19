<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-5 mb-5">
            <h2 class="text-center mb-3">Ubah Password</h2>
            <?= Flasher::alert(); ?>
            <form action="<?= BASEURL; ?>/akun/ubahPassword" method="post">
                <input type="hidden" name="id" value="<?= $data['userData']['id']; ?>">
                <div class="mb-3">
                    <label for="passwordLama" class="form-label">Password Lama:</label>
                    <input type="password" name="passwordLama" class="form-control shadow-sm" id="passwordLama" aria-describedby="passwordLamaHelp" required autofocus autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="passwordBaru" class="form-label">Password Baru:</label>
                    <input type="password" name="passwordBaru" class="form-control shadow-sm" id="passwordBaru" required autocomplete="off">
                </div>
                <a href="<?= BASEURL; ?>/akun" class="btn btn-secondary shadow">Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary shadow">Submit</button>
            </form>
        </div>
    </div>
</div>