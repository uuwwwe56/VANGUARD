<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Produk.php';

$id_produk = $_GET['id'];

$model = new Produk();
$produk = $model->find($id_produk, 'id_produk');

if (!$produk) {
    die("Produk tidak ditemukan");
}
?>

<h3>Checkout Produk</h3>

<form action="../../../controllers/transaksi.php" method="POST">

    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
    <input type="hidden" name="qty" value="1">

    <p><b><?= $produk['nama_produk'] ?></b></p>
    <p>Harga: Rp <?= number_format($produk['harga']) ?></p>

    <label>Nama Penerima</label><br>
    <textarea name="nama" required></textarea><br><br>

    <label>Alamat Lengkap</label><br>
    <textarea name="alamat" required></textarea><br><br>

    <label>No HP</label><br>
    <input type="text" name="no_hp" required><br><br>

    <label>Metode Pembayaran</label><br>
    <select name="metode_pembayaran" required>
        <option value="">-- pilih --</option>
        <option value="COD">COD</option>
        <option value="DANA">Transfer DANA</option>
    </select><br><br>

    <button type="submit" name="checkout">Bayar</button>
</form>