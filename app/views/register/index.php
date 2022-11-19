<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css?v=<?= time(); ?>">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col">
                <form class="mt-5" action="<?= BASEURL; ?>/register/daftar" method="post" enctype="multipart/form-data">
                    <h1 class="text-center">Daftar</h1>
                    <?= Flasher::alert(); ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" name="nama" class="form-control shadow-sm" id="nama" aria-describedby="namaHelp" required autocomplete="off" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control shadow-sm" id="password" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="konfirmasiPassword" class="form-label">Konfirmasi Password:</label>
                        <input type="password" name="konfirmasiPassword" class="form-control shadow-sm" id="konfirmasiPassword" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label>
                        <input type="file" name="foto" class="form-control shadow-sm" id="foto" required>
                    </div>
                    <a href="<?= BASEURL; ?>/login" class="btn btn-secondary shadow">Kembali</a>
                    <button type="submit" name="submit" class="btn btn-primary shadow">Daftar</button>
                </form>
            </div>
        </div>
    </div>