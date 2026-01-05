<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Kategori.php';

$model = new Kategori();
$kategori = $model->find($_GET['id'], 'id_kategori');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Kategori - Vanguard</title>
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: navy;
        }

        .form-card {
            max-width: 480px;
            margin: 80px auto;
            background: #fff;
            padding: 32px;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, .3);
        }
    </style>
</head>

<body>

    <div class="form-card">

        <h4 class="fw-bold mb-2">
            ✏️ Edit Kategori
        </h4>
        <p class="text-muted mb-4">
            Perbarui nama kategori
        </p>

        <form action="../../../controllers/kategori.php" method="POST">
            <input type="hidden"
                name="id_kategori"
                value="<?= $kategori['id_kategori'] ?>">

            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>
                <input type="text"
                    name="nama_kategori"
                    class="form-control"
                    value="<?= $kategori['nama_kategori'] ?>"
                    required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="index.php"
                    class="btn btn-outline-secondary rounded-pill px-4">
                    Kembali
                </a>

                <button type="submit"
                    name="update"
                    class="btn btn-warning rounded-pill px-5">
                    <i class="bi bi-check2-circle me-1"></i>
                    Update
                </button>
            </div>

        </form>

    </div>

</body>

</html>