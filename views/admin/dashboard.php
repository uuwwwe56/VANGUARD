<?php
require_once '../../middleware/admin.php';
require_once '../../core/Database.php';

$db = (new Database())->conn;

// hitung data
$total_produk    = $db->query("SELECT COUNT(*) total FROM produk")->fetch_assoc()['total'];
$total_user      = $db->query("SELECT COUNT(*) total FROM users WHERE role='user'")->fetch_assoc()['total'];
$total_kategori  = $db->query("SELECT COUNT(*) total FROM kategori")->fetch_assoc()['total'];
$total_transaksi = $db->query("SELECT COUNT(*) total FROM transaksi")->fetch_assoc()['total'];

// transaksi pending
$pending = $db->query(
    "SELECT COUNT(*) total FROM transaksi WHERE status='pending'"
)->fetch_assoc()['total'];

// testimoni
$total_testimoni      = $db->query("SELECT COUNT(*) total FROM testimoni")->fetch_assoc()['total'];
$pending_testimoni    = $db->query("SELECT COUNT(*) total FROM testimoni WHERE status='pending'")->fetch_assoc()['total'];
$approved_testimoni   = $db->query("SELECT COUNT(*) total FROM testimoni WHERE status='approved'")->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
        }

        .card h2 {
            margin: 0;
            font-size: 32px;
        }

        .card p {
            color: #666;
        }

        a.menu {
            display: inline-block;
            margin: 10px 15px 0 0;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, <b><?= $_SESSION['nama'] ?></b></p>

        <!-- MENU -->
        <div>
            <a class="menu" href="produk/index.php">📦 Produk</a>
            <a class="menu" href="kategori/index.php">🗂 Kategori</a>
            <a class="menu" href="transaksi/index.php">💳 Transaksi</a>

            <a class="menu" href="../auth/logout.php">🚪 Logout</a>
        </div>

        <!-- RINGKASAN -->
        <div class="cards">
            <div class="card">
                <h2><?= $total_produk ?></h2>
                <p>Total Produk</p>
            </div>

            <div class="card">
                <h2><?= $total_kategori ?></h2>
                <p>Kategori</p>
            </div>

            <div class="card">
                <h2><?= $total_user ?></h2>
                <p>User</p>
            </div>

            <div class="card">
                <h2><?= $total_transaksi ?></h2>
                <p>Transaksi</p>
            </div>

            <div class="card" style="background: #ffe8a1;">
                <h2><?= $pending ?></h2>
                <p>Pending Transaksi</p>
            </div>

            <!-- Testimoni -->
            <div class="card" style="background: #d1f7c4;">
                <h2><?= $total_testimoni ?></h2>
                <p>Total Testimoni</p>
            </div>

            <div class="card" style="background: #fff3cd;">
                <h2><?= $pending_testimoni ?></h2>
                <p>Pending Testimoni</p>
                <a href="testimoni/index.php" style="color:#856404; font-weight:bold;">Lihat & Approve</a>
            </div>


            <div class="card" style="background: #cce5ff;">
                <h2><?= $approved_testimoni ?></h2>
                <p>Approved Testimoni</p>
            </div>
        </div>

    </div>

</body>

</html>