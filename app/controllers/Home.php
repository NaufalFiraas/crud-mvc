<?php

class Home extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['login']) && !isset($_SESSION['id'])) {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
        $data['userNama'] = $_SESSION['nama'];
        $data['judul'] = 'Home';
        $data['mhs'] = $this->model('MahasiswaModel')->getAllMahasiswaForHome('');
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function about()
    {
        $data['judul'] = 'About';
        $this->view('templates/header', $data);
        $this->view('about/index');
        $this->view('templates/footer');
    }

    public function search()
    {
        $data['userNama'] = $_SESSION['nama'];
        $data['judul'] = 'Home';
        $data['mhs'] = $this->model('MahasiswaModel')->getAllMahasiswaForHome($_POST['search']);
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('MahasiswaModel')->tambahDataMahasiswa($_POST, $_FILES)['status']) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL);
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }
    }

    public function page($nama = 'Joni', $umur = 25)
    {
        echo 'Nama saya ' . $nama . ', saya berumur ' . $umur . ' tahun';
    }

    public function hapus($id)
    {
        if ($this->model('MahasiswaModel')->hapusDataMahasiswa($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL);
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }
    }
}
