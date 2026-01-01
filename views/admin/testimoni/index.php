<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Testimoni.php';

$model = new Testimoni();
$data  = $model->all();

?>

<h3>Testimoni Pending</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Produk</th>
        <th>Rating</th>
        <th>Komentar</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($data as $i => $t): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $t['nama_user'] ?></td>
            <td><?= $t['nama_produk'] ?></td>
            <td><?= $t['rating'] ?></td>
            <td><?= $t['komentar'] ?></td>
            <td><?= $t['status'] ?></td>
            <td>
                <?php if ($t['status'] === 'pending'): ?>
                    <a href="../../../controllers/testimoni.php?approve=<?= $t['id_testimoni'] ?>">
                        Approve
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

</table>