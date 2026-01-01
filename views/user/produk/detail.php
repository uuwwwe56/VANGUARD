<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Produk.php';
require_once '../../../models/Testimoni.php';
require_once '../../../models/DetailProduk.php';

$id = $_GET['id'];
$produkModel = new Produk();
$produk = $produkModel->find($id, 'id_produk');

$detailModel = new DetailProduk();
$detail = $detailModel->getByProduk($id);

$testimoniModel = new Testimoni();
$testimoni = $testimoniModel->getByProduk($id); // hanya approved
?>

<h3><?= $produk['nama_produk'] ?></h3>
<img src="../../../assets/img/produk/<?= $produk['gambar'] ?>" width="200">
<p><strong>Harga:</strong> Rp <?= number_format($produk['harga']) ?></p>
<p><strong>Stok:</strong> <?= $produk['stok'] ?></p>

<h3>Detail Produk</h3>
<?php if ($detail): ?>
    <p><strong>Deskripsi:</strong><br><?= $detail['deskripsi']; ?></p>
    <p><strong>Bahan:</strong> <?= $detail['bahan']; ?></p>
    <p><strong>Ukuran:</strong> <?= $detail['ukuran']; ?></p>
    <p><strong>Warna:</strong> <?= $detail['warna']; ?></p>
    <p><strong>Berat:</strong> <?= $detail['berat']; ?></p>
<?php else: ?>
    <p>Detail produk belum tersedia.</p>
<?php endif; ?>

<h3>Testimoni</h3>
<?php if (empty($testimoni)): ?>
    <p>Belum ada testimoni</p>
<?php endif; ?>
<?php foreach ($testimoni as $t): ?>
    <div style="border-bottom:1px solid #ddd; margin-bottom:10px;">
        <strong><?= $t['nama'] ?></strong><br>
        <span><?= str_repeat('⭐', $t['rating']) ?></span>
        <p><?= $t['komentar'] ?></p>
    </div>
<?php endforeach; ?>