<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/bootstrap.css?v=<?= time(); ?>">
    <title><?= $data['judul']; ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark bg-gradient">
        <div class="container">
            <a class="navbar-brand text-white fw-bold fst-italic" href="<?= BASEURL; ?>">CRUD MVC</a>
            <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php if ($data['judul'] == 'Home') : ?>
                            <a class="nav-link text-white active" aria-current="page" href="<?= BASEURL; ?>">Home</a>
                        <?php else : ?>
                            <a class="nav-link text-muted" aria-current="page" href="<?= BASEURL; ?>">Home</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item">
                        <?php if ($data['judul'] == 'About') : ?>
                            <a class="nav-link text-white active" href="#">About</a>
                        <?php else : ?>
                            <a class="nav-link text-muted" href="<?= BASEURL; ?>/home/about">About</a>
                        <?php endif; ?>
                    </li>
                </ul>
                <?php if ($data['judul'] == 'Home') : ?>
                    <form action="<?= BASEURL; ?>/home/search" method="post" class="d-flex me-2" role="search">
                        <input class="form-control me-2" name="search" id="searchInput" type="search" placeholder="Search" aria-label="Search" autocomplete="off" autofocus>
                        <button class="btn btn-outline-primary fw-semibold" type="submit">Search</button>
                    </form>
                <?php endif; ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['nama']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>/akun">Akun</a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL; ?>/logout">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>