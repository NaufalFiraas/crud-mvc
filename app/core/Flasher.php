<?php

class Flasher
{
    public static function setFlash($pesan, $aksi, $type)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $type,
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
            Data mahasiswa <strong>' . $_SESSION['flash']['pesan'] . '</strong>  ' . $_SESSION['flash']['aksi'] . '.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            unset($_SESSION['flash']);
        }
    }

    public static function setAlert($pesan, $aksi, $tipe)
    {
        $_SESSION['alert'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe,
        ];
    }

    public static function alert()
    {
        if (isset($_SESSION['alert'])) {
            echo '<div class="alert alert-' . $_SESSION['alert']['tipe'] . ' alert-dismissible fade show" role="alert">
            <strong>' . $_SESSION['alert']['pesan'] . '</strong>  ' . $_SESSION['alert']['aksi'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            unset($_SESSION['alert']);
        }
    }
}
