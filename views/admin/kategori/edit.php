<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Kategori.php';

$model = new Kategori();
$kategori = $model->find($_GET['id'], 'id_kategori');
?>

<h3>Edit Kategori</h3>

<form action="../../../controllers/kategori.php" method="POST">
    <input type="hidden" name="id_kategori"
        value="<?= $kategori['id_kategori'] ?>">

    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori"
        value="<?= $kategori['nama_kategori'] ?>" required><br><br>

    <button type="submit" name="update">Update</button>
    <a href="index.php">Kembali</a>
</form>