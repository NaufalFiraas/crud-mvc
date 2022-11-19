<?php

class Detail extends Controller
{
    public function index($id = 0)
    {
        if ($id == 0) {
            header('Location: ' . BASEURL);
            exit;
        }
        if (!isset($_SESSION['login']) && !isset($_SESSION['id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['userNama'] = $_SESSION['nama'];
        $data['judul'] = 'Detail Mahasiswa';
        $data['id'] = $id;
        $data['detail'] = $this->model('MahasiswaModel')->getDetailMahasiswa($id);
        $this->view('templates/header', $data);
        $this->view('detail/index', $data);
        $this->view('templates/footer');
    }
}
