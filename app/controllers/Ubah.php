<?php

class Ubah extends Controller
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
        $data['judul'] = 'Ubah Data Mahasiswa';
        $data['detail'] = $this->model('MahasiswaModel')->getDetailMahasiswa($id);
        $this->view('templates/header', $data);
        $this->view('ubah/index', $data);
        $this->view('templates/footer');
    }

    public function ubahData()
    {
        if ($this->model('MahasiswaModel')->ubahDataMahasiswa($_POST, $_FILES) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL);
            exit;
        } else {
            header('Location: ' . BASEURL);
            exit;
        }
    }
}
