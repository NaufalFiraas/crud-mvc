<?php

class UserModel
{
    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function selectUserById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $this->db->prepareQuery($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->resultSingle();
    }

    public function selectUser($nama)
    {
        $query = "SELECT * FROM $this->table WHERE nama = :nama";
        $this->db->prepareQuery($query);
        $this->db->bind('nama', $nama);
        $this->db->execute();

        return $this->db->resultSingle();
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
                'pesan' => 'Gagal upload file foto',
            ];
        } else {
            return [
                'status' => true,
                'pesan' => $namaBaru,
            ];
        }
    }

    public function registrasiUser($data, $foto)
    {
        // CEK APAKAH USER SUDAH TERDAFTAR
        if ($this->selectUser($data['nama']) != false) {
            return [
                'status' => false,
                'pesan' => 'Username sudah terdaftar',
            ];
        }

        $nama = htmlspecialchars((stripslashes($data['nama'])));
        $password = htmlspecialchars($data['password']);
        $konfirmasi = htmlspecialchars($data['konfirmasiPassword']);

        // CEK KONFIRMASI PASSWORD
        if ($password != $konfirmasi) {
            return [
                'status' => false,
                'pesan' => 'Konfirmasi password tidak sesuai',
            ];
        }

        // CEK FOTO
        $fotoUpload = $this->uploadFoto($foto);

        if ($fotoUpload['status'] == false) {
            return [
                'status' => false,
                'pesan' => $fotoUpload['pesan'],
            ];
        }

        // HASH / ENKRIPSI PASSWORD
        $passwordEnkripsi = password_hash($password, PASSWORD_DEFAULT);

        // MULAI REGISTRASI
        $query = "INSERT INTO $this->table (nama, password, level, foto) VALUES (
            :nama, :password, :level, :foto)";
        $this->db->prepareQuery($query);
        $this->db->bind('nama', $nama);
        $this->db->bind('password', $passwordEnkripsi);
        $this->db->bind('level', 'user');
        $this->db->bind('foto', $fotoUpload['pesan']);

        $this->db->execute();

        $result = $this->db->rowCount();

        return $result > 0 ? [
            'status' => true,
            'pesan' => 'Registrasi berhasil',
        ] : [
            'status' => false,
            'pesan' => 'Registrasi gagal',
        ];
    }

    public function login($data)
    {
        $userResult = $this->selectUser($data['nama']);
        // CEK USER APAKAH SUDAH TERDAFTAR
        if ($userResult == false) {
            return [
                'status' => false,
                'pesan' => 'User belum terdaftar',
            ];
        }

        $nama = htmlspecialchars($data['nama']);
        $password = htmlspecialchars($data['password']);
        $remember = $data['remember'];

        // CEK PASSWORDNYA
        if (password_verify($password, $userResult['password']) == false) {
            // JIKA LOGIN DARI AUTOLOGIN (REMEMBER ME)
            if ($password != $userResult['password']) {
                return [
                    'status' => false,
                    'pesan' => 'Username / password salah',
                ];
            }
        }

        // CEK REMEMBER  ME
        if ($remember) {
            setcookie('id', $userResult['id'], time() + 3600 * 24 * 2, '/');
            setcookie('key', hash('sha256', $nama), time() + 3600 * 24 * 2, '/');
        }

        // SET SESSION LOGIN
        $_SESSION['login'] = true;
        $_SESSION['id'] = $userResult['id'];
        $_SESSION['nama'] = $userResult['nama'];
        $_SESSION['level'] = $userResult['level'];
        return [
            'status' => true,
            'pesan' => 'Login berhasil',
        ];
    }

    public function logout()
    {
        // HAPUS COOKIES
        setcookie('id', '', time() - 3600, '/');
        setcookie('key', '', time() - 3600, '/');
        unset($_COOKIE['id']);
        unset($_COOKIE['key']);

        // HAPUS SESSION
        unset($_SESSION['login']);
        unset($_SESSION['id']);
        unset($_SESSION['nama']);
        unset($_SESSION['level']);
        session_unset();
        session_destroy();

        return true;
    }

    public function ubahProfile($data, $foto)
    {
        $nama = htmlspecialchars(($data['nama']));
        $fotoLama = htmlspecialchars($data['fotoLama']);
        $id = htmlspecialchars($data['id']);

        if ($foto['foto']['error'] != 4) {
            $uploadFoto = $this->uploadFoto($foto);
            if ($uploadFoto['status'] == false) {
                return [
                    'status' => false,
                    'pesan' => $uploadFoto['pesan'],
                ];
            } else {
                $fotoLama = $uploadFoto['pesan'];
            }
        }

        $query = "UPDATE $this->table SET nama = :nama, foto = :foto WHERE id = :id";
        $this->db->prepareQuery($query);
        $this->db->bind('nama', $nama);
        $this->db->bind('foto', $fotoLama);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahPassword($data)
    {
        $userData = $this->selectUserById($_SESSION['id']);
        $passwordLama = $data['passwordLama'];
        $passwordBaru = $data['passwordBaru'];
        if (password_verify($passwordLama, $userData['password']) == false) {
            return [
                'status' => false,
                'pesan' => 'Password lama tidak sesuai',
            ];
        }

        $passwordBaruHashed = password_hash($passwordBaru, PASSWORD_DEFAULT);
        $query = "UPDATE $this->table SET password = :passwordBaru WHERE id = :id";
        $this->db->prepareQuery($query);
        $this->db->bind('passwordBaru', $passwordBaruHashed);
        $this->db->bind('id', $_SESSION['id']);
        $this->db->execute();

        $rowCount = $this->db->rowCount();
        if ($rowCount > 0) {
            return [
                'status' => true,
                'pesan' => 'Password berhasil diubah',
            ];
        } else {
            return [
                'status'  => false,
                'pesan' => 'Gagal mengubah password',
            ];
        }
    }
}
