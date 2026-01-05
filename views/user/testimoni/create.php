<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Testimoni.php';

if (!isset($_GET['id_transaksi'])) {
    header("Location: ../transaksi/index.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$id_transaksi = (int) $_GET['id_transaksi'];

$model = new Testimoni();

// cegah duplikasi
if ($model->sudahAdaTransaksi($id_transaksi, $id_user)) {
    header("Location: ../transaksi/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Beri Testimoni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: navy;
        }

        .testimonial-card {
            max-width: 520px;
            margin: 80px auto;
            background: #ffffff;
            padding: 32px;
            border-radius: 20px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, .12);
            animation: fadeUp .5s ease;
        }

        .icon {
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            color: aliceblue;


        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .testimonial-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .testimonial-subtitle {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 22px;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>

    <hr class="my-4">

    <div class="text-start ms-2">
        <a href="../dashboard.php" class="btn btn-link text-decoration-none fw-semibold">
            <i class="bi bi-chevron-double-left me-1"></i> Back
        </a>
    </div>

    <div class="testimonial-card">

        <h3 class="testimonial-title">
            ⭐ Beri Testimoni
        </h3>
        <p class="testimonial-subtitle">
            Bagikan pengalaman kamu setelah menerima produk
        </p>

        <form action="../../../controllers/testimoni.php" method="POST">
            <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">

            <!-- RATING -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Rating
                </label>
                <select name="rating" class="form-select" required>
                    <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                    <option value="4">⭐⭐⭐⭐ Puas</option>
                    <option value="3">⭐⭐⭐ Cukup</option>
                    <option value="2">⭐⭐ Kurang</option>
                    <option value="1">⭐ Sangat Buruk</option>
                </select>
            </div>

            <!-- KOMENTAR -->
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Komentar
                </label>
                <textarea name="komentar"
                    rows="4"
                    class="form-control"
                    placeholder="Ceritakan pengalaman kamu..."
                    required></textarea>
            </div>

            <!-- BUTTON -->
            <div class="d-grid gap-2">
                <button type="submit"
                    name="kirim"
                    class="btn btn-success btn-lg rounded-pill">
                    <i class="bi bi-send-check me-2"></i>
                    Kirim Testimoni
                </button>

                <a href="../transaksi/index.php"
                    class="btn btn-outline-secondary rounded-pill">
                    Batal
                </a>
            </div>
        </form>

    </div>

</body>

</html>