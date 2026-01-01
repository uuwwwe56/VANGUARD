<?php
session_start();
require_once __DIR__ . '/../core/Database.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header("Location: ../views/auth/login.php");
    exit;
}

$db = (new Database())->conn;

/* ================= TAMBAH KE KERANJANG ================= */
if (isset($_POST['add_cart'])) {

    $id_user   = $_SESSION['id_user'];
    $id_produk = $_POST['id_produk'];
    $qty       = (int) $_POST['qty'];
    $ukuran    = $_POST['ukuran'];

    // CEK apakah produk + ukuran sudah ada
    $stmt = $db->prepare("
    SELECT id_keranjang FROM keranjang
    WHERE id_user = ? AND id_produk = ? AND ukuran = ?
");
    $stmt->bind_param("iis", $id_user, $id_produk, $ukuran);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // UPDATE
        $update = $db->prepare("
        UPDATE keranjang
        SET qty = qty + ?
        WHERE id_user = ? AND id_produk = ? AND ukuran = ?
    ");
        $update->bind_param("iiis", $qty, $id_user, $id_produk, $ukuran);
        $update->execute();
    } else {
        // INSERT
        $insert = $db->prepare("
        INSERT INTO keranjang (id_user, id_produk, qty, ukuran)
        VALUES (?, ?, ?, ?)
    ");
        $insert->bind_param("iiis", $id_user, $id_produk, $qty, $ukuran);
        $insert->execute();
    }
    header("Location: ../views/user/keranjang/index.php");
    exit;
}

/* ================= HAPUS ITEM KERANJANG (AJAX) ================= */
if (isset($_POST['hapus'])) {

    $id_keranjang = (int) $_POST['id_keranjang'];
    $id_user = $_SESSION['id_user'];

    $stmt = $db->prepare("
        DELETE FROM keranjang 
        WHERE id_keranjang = ? 
        AND id_user = ?
    ");
    $stmt->bind_param("ii", $id_keranjang, $id_user);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "failed";
    }

    exit; // ⬅️ WAJIB
}
