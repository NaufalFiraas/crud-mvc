<?php
$alert = '';
if (isset($_POST['submit'])) {
    $password = $_POST["password"];
    $konfirmasi = $_POST['konfirmasiPassword'];
    if ($password != $konfirmasi) {
        $alert = 'Konfirmasi password tidak sesuai';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css?v=<?= time(); ?>">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col">
                <form class="mt-5" action="<?= BASEURL; ?>/login/masuk" method="post">
                    <h1 class="text-center">Login</h1>
                    <?= Flasher::alert(); ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" name="nama" class="form-control shadow-sm" id="nama" aria-describedby="namaHelp" required autocomplete="off" autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control shadow-sm" id="password" required autocomplete="off">
                    </div>
                    <div class="mb-3 form-check d-flex justify-content-between">
                        <div class="remember">
                            <input type="checkbox" name="remember" class="form-check-input shadow-sm" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <a href="<?= BASEURL; ?>/register" class="text-decoration-none">Daftar</a>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary shadow">Login</button>
                </form>
            </div>
        </div>
    </div>