<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Kategori.php';
?>

<h3>Tambah Produk</h3>

<form action="../../../controllers/produk.php" method="POST" enctype="multipart/form-data">

    <div>
        <label>Nama Produk</label><br>
        <input type="text" name="nama_produk" required>
    </div>

    <div>
        <label>Kategori</label><br>
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php
            $kategori = new Kategori();
            foreach ($kategori->get() as $row):
            ?>
                <option value="<?= $row['id_kategori'] ?>">
                    <?= $row['nama_kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label>Harga</label><br>
        <input type="number" name="harga" required>
    </div>

    <div>
        <label>Stok</label><br>
        <input type="number" name="stok" required>
    </div>

    <div>
        <label>Gambar</label><br>
        <input type="file" name="gambar">
    </div>

    <br>
    <button type="submit" name="create">Simpan</button>
    <a href="index.php">Kembali</a>

</form>