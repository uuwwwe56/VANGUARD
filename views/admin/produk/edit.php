<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Produk.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$model  = new Produk();
$produk = $model->find($_GET['id'], 'id_produk');

if (!$produk) {
    header("Location: index.php");
    exit;
}
?>

<h3>Edit Produk</h3>

<form action="../../../controllers/produk.php"
    method="POST"
    enctype="multipart/form-data">

    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">

    <div>
        <label>Nama Produk</label>
        <input type="text" name="nama_produk"
            value="<?= $produk['nama_produk'] ?>" required>
    </div>

    <div>
        <label>Kategori</label>
        <input type="number" name="id_kategori"
            value="<?= $produk['id_kategori'] ?>" required>
        <small>(sementara pakai ID kategori)</small>
    </div>

    <div>
        <label>Harga</label>
        <input type="number" name="harga"
            value="<?= $produk['harga'] ?>" required>
    </div>

    <div>
        <label>Stok</label>
        <input type="number" name="stok"
            value="<?= $produk['stok'] ?>" required>
    </div>

    <div>
        <label>Gambar Lama</label><br>
        <?php if ($produk['gambar']): ?>
            <img src="../../../assets/img/produk/<?= $produk['gambar'] ?>"
                width="80">
        <?php else: ?>
            <em>Tidak ada gambar</em>
        <?php endif; ?>
    </div>

    <div>
        <label>Ganti Gambar (opsional)</label>
        <input type="file" name="gambar">
    </div>

    <button type="submit" name="update">Update</button>
    <a href="index.php">Kembali</a>
</form>