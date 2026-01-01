<?php
require_once '../../middleware/auth.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
</head>

<body>

    <h3>Halo, <?= $_SESSION['nama']; ?></h3>
    <p>Role: <?= $_SESSION['role']; ?></p>

    <ul>
        <li><a href="produk/index.php">Lihat Produk</a></li>
        <li><a href="transaksi/index.php">Transaksi Saya</a></li>
    </ul>

    <a href="../../controllers/logout.php">Logout</a>

</body>

</html>