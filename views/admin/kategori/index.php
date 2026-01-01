<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Kategori.php';

$model = new Kategori();
$data  = $model->get();
?>

<h3>Data Kategori</h3>
<a href="create.php">+ Tambah Kategori</a>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($data as $i => $row): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $row['nama_kategori'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_kategori'] ?>">Edit</a> |
                <a href="../../../controllers/kategori.php?delete=<?= $row['id_kategori'] ?>"
                    onclick="return confirm('Hapus kategori?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>