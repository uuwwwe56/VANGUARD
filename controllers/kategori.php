<?php
session_start();

require_once __DIR__ . '/../models/Kategori.php';

$model = new Kategori();

/*
|--------------------------------------------------------------------------
| TAMBAH KATEGORI
|--------------------------------------------------------------------------
*/
if (isset($_POST['create'])) {

    $nama = trim($_POST['nama_kategori']);

    if ($nama === '') {
        $_SESSION['error'] = 'Nama kategori wajib diisi';
        header("Location: ../views/admin/kategori/create.php");
        exit;
    }

    $model->insert([
        'nama_kategori' => $nama
    ]);

    header("Location: ../views/admin/kategori/index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| UPDATE KATEGORI
|--------------------------------------------------------------------------
*/
if (isset($_POST['update'])) {

    $id   = $_POST['id_kategori'];
    $nama = trim($_POST['nama_kategori']);

    $model->update($id, [
        'nama_kategori' => $nama
    ], 'id_kategori');

    header("Location: ../views/admin/kategori/index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| HAPUS KATEGORI
|--------------------------------------------------------------------------
*/
if (isset($_GET['delete'])) {

    $model->delete($_GET['delete'], 'id_kategori');

    header("Location: ../views/admin/kategori/index.php");
    exit;
}
