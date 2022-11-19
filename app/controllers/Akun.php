<?php

class Akun extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['login']) && !isset($_SESSION['id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['judul'] = 'Akun';
        $data['userData'] = $this->model('UserModel')->selectUser($_SESSION['nama']);
        $this->view('templates/header', $data);
        $this->view('akun/index', $data);
        $this->view('templates/footer');
    }

    public function halamanUbah()
    {
        if (!isset($_SESSION['login']) && !isset($_SESSION['id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['judul'] = 'Akun';
        $data['userData'] = $this->model('UserModel')->selectUser($_SESSION['nama']);
        $this->view('templates/header', $data);
        $this->view('akun/ubah', $data);
        $this->view('templates/footer');
    }

    public function halamanUbahPassword()
    {
        if (!isset($_SESSION['login']) && !isset($_SESSION['id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
        
        $data['judul'] = 'Akun';
        $this->view('templates/header', $data);
        $this->view('akun/password');
        $this->view('templates/footer');
    }

    public function ubahProfile()
    {
        $result = $this->model('UserModel')->ubahProfile($_POST, $_FILES);
        if (is_array($result)) {
            if ($result['status'] == false) {
                Flasher::setAlert($result['pesan'], '', 'danger');
                exit;
            }
        } else if ($result > 0) {
            Flasher::setAlert('Data berhasil', 'diubah', 'success');
            $userData = $this->model('UserModel')->selectUserById($_SESSION['id']);
            $_SESSION['nama'] = $userData['nama'];
            header('Location: ' . BASEURL . '/akun');
            exit;
        } else {
            header('Location: ' . BASEURL . '/akun');
            exit;
        }
    }

    public function ubahPassword()
    {
        $result = $this->model('UserModel')->ubahPassword($_POST);
        if ($result['status'] == false) {
            if ($result['pesan'] == 'Password lama tidak sesuai') {
                Flasher::setAlert('Password lama', 'tidak sesuai', 'danger');
                header('Location: ' . BASEURL . '/akun/halamanUbahPassword');
                exit;
            } else {
                header('Location: ' . BASEURL . '/akun');
                exit;
            }
        } else {
            Flasher::setAlert('Password berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/akun');
            exit;
        }
    }
}
