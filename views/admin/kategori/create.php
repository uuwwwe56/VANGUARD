<?php
require_once '../../../middleware/admin.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori - Vanguard</title>
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
            ➕ Tambah Kategori
        </h4>
        <p class="text-muted mb-4">
            Masukkan nama kategori baru
        </p>

        <form action="../../../controllers/kategori.php" method="POST">

            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Nama Kategori
                </label>
                <input type="text"
                    name="nama_kategori"
                    class="form-control"
                    placeholder="Contoh: Hoodie"
                    required>
            </div>

            <div class="d-flex justify-content-between">
                <a href="index.php"
                    class="btn btn-outline-secondary rounded-pill px-4">
                    Kembali
                </a>

                <button type="submit"
                    name="create"
                    class="btn btn-success rounded-pill px-5">
                    <i class="bi bi-save me-1"></i>
                    Simpan
                </button>
            </div>

        </form>

    </div>

</body>

</html>