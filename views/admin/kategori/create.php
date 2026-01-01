<?php require_once '../../../middleware/admin.php'; ?>

<h3>Tambah Kategori</h3>

<form action="../../../controllers/kategori.php" method="POST">
    <label>Nama Kategori</label><br>
    <input type="text" name="nama_kategori" required><br><br>

    <button type="submit" name="create">Simpan</button>
    <a href="index.php">Kembali</a>
</form>