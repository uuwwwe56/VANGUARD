<?php
require_once '../../../middleware/user.php';
require_once '../../../core/Database.php';

$db = (new Database())->conn;
$id_user = $_SESSION['id_user'];

/* ================= AMBIL DATA KERANJANG ================= */
$data = $db->query("
    SELECT 
        k.id_keranjang,
        k.qty,
        k.ukuran,
        p.id_produk,
        p.nama_produk,
        p.harga,
        p.gambar,
        (k.qty * p.harga) AS subtotal
    FROM keranjang k
    JOIN produk p ON k.id_produk = p.id_produk
    WHERE k.id_user = '$id_user'
");

if ($data->num_rows === 0) {
    die("Keranjang kosong");
}

/* ================= HITUNG TOTAL ================= */
$total = 0;
$items = [];
foreach ($data as $k) {
    $total += $k['subtotal'];
    $items[] = $k; // simpan data untuk form
}
?>

<h3>Checkout Keranjang</h3>

<form action="../../../controllers/transaksi.php" method="POST">

    <?php foreach ($items as $i => $k): ?>
        <input type="hidden" name="produk_id[]" value="<?= $k['id_produk'] ?>">
        <input type="hidden" name="qty[]" value="<?= $k['qty'] ?>">
        <input type="hidden" name="ukuran[]" value="<?= $k['ukuran'] ?>">

        <p><b><?= $k['nama_produk'] ?></b> | <?= $k['qty'] ?> pcs | Rp <?= number_format($k['subtotal']) ?></p>
    <?php endforeach; ?>

    <p><strong>Total: Rp <?= number_format($total) ?></strong></p>

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

    <button type="submit" name="checkout_cart">Bayar Semua</button>
</form>