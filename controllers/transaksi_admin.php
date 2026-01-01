<?php
session_start();
require_once __DIR__ . '/../models/Transaksi.php';

// proteksi admin
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../views/auth/login.php");
    exit;
}

$model = new Transaksi();

/* ================= UPDATE STATUS DARI DROPDOWN ================= */

if (isset($_POST['update_status'])) {

    $id = (int) $_POST['id_transaksi'];
    $status = $_POST['status'];

    $model = new Transaksi();
    $model->updateStatus($id, $status);

    $_SESSION['success'] = "Status transaksi berhasil diupdate!";
    header("Location: ../views/admin/transaksi/index.php");
    exit;
}


/* ================= VERIFIKASI DANA ================= */
if (isset($_POST['verifikasi'])) {

    $id     = $_POST['id_transaksi'];
    $status = $_POST['status']; // dibayar / batal

    $model->updateStatus($id, $status);

    header("Location: ../views/admin/transaksi/index.php");
    exit;
}
