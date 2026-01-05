<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Testimoni.php';

$model = new Testimoni();
$data  = $model->all();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Testimoni - Vanguard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: navy;
            min-height: 100vh;
        }

        .card {
            border-radius: 18px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, .3);
        }

        .icon {
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            color: aliceblue;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <a href="../dashboard.php" class="icon">
            <i class="bi bi-chevron-double-left"></i> Back
        </a>
        <hr>
        <div class="card p-4">
            <h4 class="fw-bold mb-4">
                📝 Testimoni Pelanggan
            </h4>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Produk</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $i => $t): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $t['nama_user'] ?></td>
                                <td><?= $t['nama_produk'] ?></td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        ⭐ <?= $t['rating'] ?>/5
                                    </span>
                                </td>
                                <td><?= $t['komentar'] ?></td>
                                <td>
                                    <span class="badge <?= $t['status'] === 'pending' ? 'bg-secondary' : 'bg-success' ?>">
                                        <?= strtoupper($t['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($t['status'] === 'pending'): ?>
                                        <a href="../../../controllers/testimoni.php?approve=<?= $t['id_testimoni'] ?>"
                                            class="btn btn-sm btn-success rounded-pill">
                                            Approve
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small">Approved</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>