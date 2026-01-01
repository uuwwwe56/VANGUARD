<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Produk.php';

$model = new Produk();
$produk = $model->allWithKategori();
?>

<h3>Produk Vanguard</h3>
<a href="../keranjang/index.php">Keranjang</a>
<div style="display:flex; gap:20px; flex-wrap:wrap;">
    <?php foreach ($produk as $p): ?>
        <div style="border:1px solid #ccc; padding:10px; width:200px;">

            <img src="../../../assets/img/produk/<?= $p['gambar'] ?>" width="180">

            <h4><?= $p['nama_produk'] ?></h4>

            <p><?= $p['nama_kategori'] ?></p>

            <p><strong>Rp <?= number_format($p['harga']) ?></strong></p>

            <!-- DETAIL -->
            <a href="detail.php?id=<?= $p['id_produk'] ?>">Detail</a>

            <br><br>

            <!-- BELI LANGSUNG -->
            <?php if ($p['stok'] > 0): ?>

                <!-- FORM KERANJANG -->
                <form action="../../../controllers/keranjang.php" method="POST">
                    <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">

                    <label>Jumlah</label><br>
                    <input type="number" name="qty" min="1" max="<?= $p['stok'] ?>" required><br>

                    <label>Ukuran</label><br>
                    <select name="ukuran" required>
                        <option value="">-- pilih --</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select><br><br>

                    <button type="submit" name="add_cart">
                        ➕ Keranjang
                    </button>
                </form>

                <br>

                <!-- BELI LANGSUNG (TETAP) -->
                <a href="../transaksi/checkout.php?id=<?= $p['id_produk'] ?>"
                    style="display:inline-block; padding:6px 10px; background:#28a745; color:#fff; text-decoration:none;">
                    🛒 Beli
                </a>

            <?php else: ?>
                <small style="color:red;">Stok habis</small>
            <?php endif; ?>



        </div>
    <?php endforeach; ?>
</div>