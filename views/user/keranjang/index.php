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

$total = 0;
?>

<h3>Keranjang Saya</h3>

<?php if ($data->num_rows === 0): ?>
    <p>Keranjang masih kosong.</p>
    <a href="../produk/index.php">⬅️ Kembali Belanja</a>

<?php else: ?>

    <table border="1" cellpadding="8" width="100%">
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Ukuran</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($data as $i => $k): ?>
            <?php $total += $k['subtotal']; ?>
            <tr>
                <td><?= $i + 1 ?></td>

                <td>
                    <img src="../../../assets/img/produk/<?= $k['gambar'] ?>" width="60"><br>
                    <?= $k['nama_produk'] ?>
                </td>

                <td><?= $k['ukuran'] ?></td>
                <td><?= $k['qty'] ?></td>
                <td>Rp <?= number_format($k['harga']) ?></td>
                <td><strong>Rp <?= number_format($k['subtotal']) ?></strong></td>
                <td>
                    <button onclick="hapusItem(<?= $k['id_keranjang'] ?>)">
                        🗑️ Hapus
                    </button>

                </td>


            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="5" align="right"><strong>Total</strong></td>
            <td colspan="2"><strong>Rp <?= number_format($total) ?></strong></td>
        </tr>
    </table>

    <br>

    <!-- ================= CHECKOUT ================= -->
    <form action="../transaksi/checkout_cart.php" method="POST">
        <button type="submit" name="checkout_cart"
            style="padding:10px 20px;background:#28a745;color:#fff;border:none;">
            🛒 Checkout Semua
        </button>
    </form>

<?php endif; ?>

<script>
    function hapusItem(id) {
        if (!confirm('Yakin ingin menghapus item ini dari keranjang?')) {
            return;
        }

        fetch("../../../controllers/keranjang.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "hapus=1&id_keranjang=" + id
            })
            .then(res => res.text())
            .then(res => {
                if (res.trim() === 'success') {
                    alert('Item berhasil dihapus');
                    location.reload(); // tetap di halaman keranjang
                } else {
                    alert('Gagal menghapus item');
                }
            })
            .catch(() => {
                alert('Terjadi kesalahan koneksi');
            });
    }
</script>