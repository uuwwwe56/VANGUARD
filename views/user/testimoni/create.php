<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Testimoni.php';

if (!isset($_GET['id_transaksi'])) {
    header("Location: ../transaksi/index.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_transaksi = (int) $_GET['id_transaksi'];

$model = new Testimoni();

// cegah duplikasi
if ($model->sudahAdaTransaksi($id_transaksi, $id_user)) {
    header("Location: ../transaksi/index.php");
    exit;
}
?>

<h3>Beri Testimoni</h3>

<form action="../../../controllers/testimoni.php" method="POST">
    <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">

    <label>Rating:</label>
    <select name="rating" required>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select>

    <br><br>
    <label>Komentar:</label><br>
    <textarea name="komentar" rows="4" required></textarea>
    <br><br>

    <button type="submit" name="kirim">Kirim Testimoni</button>
</form>