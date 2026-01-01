<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Produk.php';

$model = new Produk();
$data  = $model->allWithKategori();
?>

<h3>Data Produk</h3>
<a href="create.php">+ Tambah Produk</a>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($data as $i => $row): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td><?= $row['nama_kategori'] ?? '-' ?></td>
            <td><?= number_format($row['harga']) ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
                <?php if ($row['gambar']): ?>
                    <img src="../../../assets/img/produk/<?= $row['gambar'] ?>" width="60">
                <?php endif; ?>
            </td>
            <td>
                <a href="edit.php?id=<?= $row['id_produk'] ?>">Edit</a> |
                <a href="../../../controllers/produk.php?delete=<?= $row['id_produk'] ?>"
                    onclick="return confirm('Hapus produk?')">Hapus</a>
                <a href="detail_form.php?id=<?= $row['id_produk'] ?>"
                    class="btn btn-info btn-sm">
                    Detail Produk
                </a>

            </td>
        </tr>
    <?php endforeach; ?>
</table>