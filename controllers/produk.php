<?php
session_start();

require_once __DIR__ . '/../models/Produk.php';

$model = new Produk();

/*
|--------------------------------------------------------------------------|
| TAMBAH PRODUK
|--------------------------------------------------------------------------|
*/
if (isset($_POST['create'])) {

    $nama_produk = trim($_POST['nama_produk']);
    $id_kategori = $_POST['id_kategori'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];

    if ($nama_produk === '' || $id_kategori === '' || $harga === '' || $stok === '') {
        $_SESSION['error'] = 'Semua field wajib diisi';
        header("Location: ../views/admin/produk/create.php");
        exit;
    }

    // =====================
    // UPLOAD GAMBAR
    // =====================
    $gambar = null;

    if (!empty($_FILES['gambar']['name'])) {
        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed)) {
            $_SESSION['error'] = 'Format gambar tidak didukung';
            header("Location: ../views/admin/produk/create.php");
            exit;
        }

        // nama random unik
        $gambar = uniqid('produk_', true) . '.' . $ext;

        $uploadDir = __DIR__ . '/../assets/img/produk/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambar);
    }

    // =====================
    // INSERT KE DATABASE
    // =====================
    $result = $model->insert([
        'nama_produk' => $nama_produk,
        'id_kategori' => $id_kategori,
        'harga'       => $harga,
        'stok'        => $stok,
        'gambar'      => $gambar
    ]);

    if ($result) {
        $_SESSION['success'] = 'Produk berhasil ditambahkan';
        header("Location: ../views/admin/produk/index.php");
    } else {
        $_SESSION['error'] = 'Gagal menambahkan produk';
        header("Location: ../views/admin/produk/create.php");
    }
    exit;
}

/*
|--------------------------------------------------------------------------|
| HAPUS PRODUK
|--------------------------------------------------------------------------|
*/
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    // hapus gambar
    $produk = $model->find($id, 'id_produk');
    if ($produk && $produk['gambar']) {
        $file = __DIR__ . '/../assets/img/produk/' . $produk['gambar'];
        if (file_exists($file)) unlink($file);
    }

    $model->delete($id, 'id_produk');

    header("Location: ../views/admin/produk/index.php");
    exit;
}

/*
|--------------------------------------------------------------------------|
| UPDATE PRODUK
|--------------------------------------------------------------------------|
*/
if (isset($_POST['update'])) {

    $id = $_POST['id_produk'];

    $data = [
        'nama_produk' => $_POST['nama_produk'],
        'id_kategori' => $_POST['id_kategori'],
        'harga'       => $_POST['harga'],
        'stok'        => $_POST['stok'],
    ];

    // Ambil data lama
    $produk = $model->find($id, 'id_produk');

    // =====================
    // JIKA GANTI GAMBAR
    // =====================
    if (!empty($_FILES['gambar']['name'])) {

        // hapus gambar lama
        if ($produk['gambar']) {
            $old = __DIR__ . '/../assets/img/produk/' . $produk['gambar'];
            if (file_exists($old)) unlink($old);
        }

        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed)) {
            $_SESSION['error'] = 'Format gambar tidak didukung';
            header("Location: ../views/admin/produk/edit.php?id=$id");
            exit;
        }

        $gambar = uniqid('produk_', true) . '.' . $ext;

        $uploadDir = __DIR__ . '/../assets/img/produk/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambar);

        $data['gambar'] = $gambar;
    }

    $model->update($id, $data, 'id_produk');

    $_SESSION['success'] = 'Produk berhasil diupdate';
    header("Location: ../views/admin/produk/index.php");
    exit;
}
