<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Kategori.php';

$model = new Kategori();
$data  = $model->get();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kategori - Vanguard</title>
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    📂 Data Kategori
                </h4>

                <a href="create.php"
                    class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Kategori
                </a>
            </div>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kategori</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $row['nama_kategori'] ?></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id_kategori'] ?>"
                                    class="btn btn-sm btn-warning rounded-pill">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <a href="../../../controllers/kategori.php?delete=<?= $row['id_kategori'] ?>"
                                    onclick="return confirm('Hapus kategori?')"
                                    class="btn btn-sm btn-danger rounded-pill ms-1">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>