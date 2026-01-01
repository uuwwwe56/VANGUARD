<?php
session_start();
require_once __DIR__ . '/../models/Testimoni.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../views/auth/login.php");
    exit;
}

$model = new Testimoni();

if (isset($_POST['kirim'])) {

    // 🔥 ambil id_produk dari transaksi
    $id_produk = $model->getProdukByTransaksi((int)$_POST['id_transaksi']);

    if (!$id_produk) {
        die('Produk tidak ditemukan dari transaksi');
    }

    $model->create([
        'id_user'      => $_SESSION['id_user'],
        'id_transaksi' => (int) $_POST['id_transaksi'],
        'id_produk'    => $id_produk, // ✅ AMAN & VALID
        'rating'       => $_POST['rating'],
        'komentar'     => $_POST['komentar'],
        'status'       => 'pending'
    ]);

    header("Location: ../views/user/transaksi/index.php");
    exit;
}



/* =======================
   ADMIN APPROVE
======================= */
if (isset($_GET['approve'])) {
    $id = (int) $_GET['approve'];

    $model->updateStatus($id, 'approved');

    header("Location: ../views/admin/testimoni/index.php");
    exit;
}
