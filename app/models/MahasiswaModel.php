<?php

class MahasiswaModel
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllMahasiswaForHome($params)
    {
        $query = "SELECT nama, jurusan, id FROM $this->table WHERE nama LIKE '$params%' OR jurusan LIKE '$params%' ORDER BY jurusan";
        $this->db->prepareQuery($query);
        return $this->db->resultSet();
    }

    public function tambahDataMahasiswa($data, $foto)
    {
        $nama = htmlspecialchars($data['nama']);
        $nrp = htmlspecialchars($data['nrp']);
        $email = htmlspecialchars($data['email']);
        $jurusan = htmlspecialchars($data['jurusan']);
        $asal = htmlspecialchars($data['asal']);

        $uploadFoto = $this->uploadFoto($foto);
        if (!$uploadFoto['status']) {
            return [
                'status' => false,
                'pesan' => $uploadFoto['pesan'],
            ];
        }

        $query = "INSERT INTO $this->table (nama, nrp, email, jurusan, asal, foto) VALUES (
            :nama, :nrp, :email, :jurusan, :asal, :foto
        )";

        $this->db->prepareQuery($query);
        $this->db->bind('nama', $nama);
        $this->db->bind('nrp', $nrp);
        $this->db->bind('email', $email);
        $this->db->bind('jurusan', $jurusan);
        $this->db->bind('asal', $asal);
        $this->db->bind('foto', $uploadFoto['pesan']);

        $this->db->execute();

        $rowCount = $this->db->rowCount();
        if ($rowCount > 0) {
            return [
                'status' => true,
                'pesan' => 'berhasil tambah data',
            ];
        } else {
            return [
                'status' => false,
                'pesan' => 'gagal tambah data',
            ];
        }
    }

    public function uploadFoto($data)
    {
        $name = $data['foto']['name'];
        $tmpName = $data['foto']['tmp_name'];
        $error = $data['foto']['error'];
        $size = $data['foto']['size'];

        if ($error == 4) {
            return [
                'status' => false,
                'pesan' => 'Tidak ada file gambar',
            ];
        }

        $namaExploded = explode('.', $name);
        $ekstensi = strtolower(end($namaExploded));
        $allowableExtension = ['jpg', 'png', 'jpeg'];
        if (!in_array($ekstensi, $allowableExtension)) {
            return [
                'status' => false,
                'pesan' => 'Ekstensi file tidak sesuai',
            ];
        }

        if ($size > 2000000) {
            return [
                'status' => false,
                'pesan' => 'Maksimal ukuran file 2mb',
            ];
        }

        $namaBaru = uniqid() .  '.' . $ekstensi;
        $lokasiGambar = $_SERVER['DOCUMENT_ROOT'] . '/crud-mvc/public/img/' . $namaBaru;
        $uploadResult = move_uploaded_file($tmpName, $lokasiGambar);

        if (!$uploadResult) {
            return [
                'status' => false,
                'pesan' => 'Gagal upload file',
            ];
        } else {
            return [
                'status' => true,
                'pesan' => $namaBaru,
            ];
        }
    }

    public function getDetailMahasiswa($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id = :id";
        $this->db->prepareQuery($query);
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $this->db->prepareQuery($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        $rowCount = $this->db->rowCount();

        return $rowCount == 0 ? false : true;
    }

    public function ubahDataMahasiswa($data, $fotoBaru)
    {
        $id = htmlspecialchars($data['id']);
        $nama = htmlspecialchars($data['nama']);
        $nrp = htmlspecialchars($data['nrp']);
        $email = htmlspecialchars($data['email']);
        $jurusan = htmlspecialchars($data['jurusan']);
        $asal = htmlspecialchars($data['asal']);
        $foto = htmlspecialchars($data['fotoLama']);

        if ($fotoBaru['foto']['error'] != 4) {
            $resultUpload = $this->uploadFoto($fotoBaru);
            if (!$resultUpload) {
                return [
                    'status' => false,
                    'pesan' => $resultUpload['pesan'],
                ];
            }
            $foto = $resultUpload['pesan'];
        }

        $query = "UPDATE $this->table SET 
        nama = :nama,
        nrp = :nrp,
        email = :email,
        jurusan = :jurusan,
        asal = :asal,
        foto = :foto
        WHERE id = :id";
        $this->db->prepareQuery($query);
        $this->db->bind('nama', $nama);
        $this->db->bind('nrp', $nrp);
        $this->db->bind('email', $email);
        $this->db->bind('jurusan', $jurusan);
        $this->db->bind('asal', $asal);
        $this->db->bind('foto', $foto);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
