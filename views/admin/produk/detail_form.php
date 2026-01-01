<?php
require_once __DIR__ . '/../../../models/DetailProduk.php';
$detailModel = new DetailProduk();
$detail = isset($_GET['id']) ? $detailModel->getByProduk($_GET['id']) : null;
?>

<h2>Detail Produk</h2>

<form method="POST" action="../../../controllers/detail_produk.php">

    <input type="hidden" name="action" value="<?= $detail ? 'update' : 'create' ?>">
    <input type="hidden" name="id_produk" value="<?= $_GET['id'] ?>">

    <div>
        <label>Deskripsi</label>
        <textarea name="deskripsi" required><?= $detail['deskripsi'] ?? '' ?></textarea>
    </div>

    <div>
        <label>Bahan</label>
        <input type="text" name="bahan" value="<?= $detail['bahan'] ?? '' ?>" required>
    </div>

    <div>
        <label>Ukuran</label>
        <input type="text" name="ukuran" value="<?= $detail['ukuran'] ?? '' ?>" required>
    </div>

    <button type="submit">
        <?= $detail ? 'Update' : 'Simpan' ?>
    </button>
</form>