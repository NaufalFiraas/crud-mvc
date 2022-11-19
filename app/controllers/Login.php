<?php

class Login extends Controller
{

    public function index()
    {
        if (isset($_COOKIE['key']) && isset($_COOKIE['id'])) {
            $cekUser = $this->model('UserModel')->selectUserById($_COOKIE['id']);
            if ($cekUser != false) {
                if ($_COOKIE['key'] == hash('sha256', $cekUser['nama'])) {
                    $this->model('UserModel')->login($cekUser);
                }
            }
        }

        if (isset($_SESSION['login'])) {
            header('Location: ' . BASEURL);
            exit;
        }

        $this->view('login/index');
        $this->view('templates/footer');
    }

    public function masuk()
    {
        $result = $this->model('UserModel')->login($_POST);

        if ($result['status'] == false) {
            Flasher::setAlert($result['pesan'], '', 'danger');
            header('Location: ' . BASEURL . '/login');
            exit;
        } else {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }
}
