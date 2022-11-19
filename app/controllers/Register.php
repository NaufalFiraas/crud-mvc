<?php

class Register extends Controller
{

    public function index()
    {
        if (isset($_SESSION['login'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $this->view('register/index');
        $this->view('templates/footer');
    }

    public function daftar()
    {
        $result = $this->model('UserModel')->registrasiUser($_POST, $_FILES);
        if (!$result['status']) {
            Flasher::setAlert($result['pesan'], '', 'danger');
            header('Location: ' . BASEURL . '/register');
            exit;
        } else {
            Flasher::setAlert($result['pesan'], '', 'success');
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }
}
