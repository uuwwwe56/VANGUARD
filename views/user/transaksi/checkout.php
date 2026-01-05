<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Produk.php';

$id_produk = $_GET['id'];

$model = new Produk();
$produk = $model->find($id_produk, 'id_produk');

if (!$produk) {
    die("Produk tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Produk</title>
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

        .checkout-card {
            max-width: 620px;
            margin: 70px auto;
            background: #ffffff;
            padding: 34px;
            border-radius: 22px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, .25);
            animation: fadeUp .5s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-box {
            background: #f8fafc;
            padding: 16px 18px;
            border-radius: 14px;
            margin-bottom: 24px;
        }

        .product-box h5 {
            margin-bottom: 6px;
            font-weight: 700;
        }

        .price {
            font-size: 18px;
            font-weight: 700;
            color: #16a34a;
        }

        textarea {
            resize: none;
        }

        .btn {
            margin-top: 20px;
            font-size: 18px;
            font-weight: 500;
            color: aliceblue;
        }
    </style>
</head>

<body>
    <div class="text-start ms-2">
        <a href="../produk/index.php" class="btn btn-link text-decoration-none fw-semibold">
            <i class="bi bi-chevron-double-left me-1"></i> Back
        </a>
    </div>
    <div class="checkout-card">

        <h3 class="fw-bold mb-1">
            🧾 Checkout Produk
        </h3>
        <p class="text-muted mb-4">
            Lengkapi data pengiriman dan pembayaran
        </p>

        <!-- INFO PRODUK -->
        <div class="product-box">
            <h5><?= $produk['nama_produk'] ?></h5>
            <div class="price">
                Rp <?= number_format($produk['harga']) ?>
            </div>
        </div>

        <form action="../../../controllers/transaksi.php" method="POST">

            <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
            <input type="hidden" name="qty" value="1">

            <!-- NAMA -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Nama Penerima
                </label>
                <input type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Nama lengkap penerima"
                    required>
            </div>

            <!-- ALAMAT -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    Alamat Lengkap
                </label>
                <textarea name="alamat"
                    rows="3"
                    class="form-control"
                    placeholder="Alamat lengkap pengiriman"
                    required></textarea>
            </div>

            <!-- NO HP -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    No HP
                </label>
                <input type="text"
                    name="no_hp"
                    class="form-control"
                    placeholder="08xxxxxxxxxx"
                    required>
            </div>

            <!-- PEMBAYARAN -->
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Metode Pembayaran
                </label>
                <select name="metode_pembayaran"
                    class="form-select"
                    required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="COD">🚚 COD (Bayar di Tempat)</option>
                    <option value="DANA">💳 Transfer DANA</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="d-grid gap-2">
                <button type="submit"
                    name="checkout"
                    class="btn btn-success btn-lg rounded-pill">
                    <i class="bi bi-credit-card me-2"></i>
                    Bayar Sekarang
                </button>

                <a href="../produk/index.php"
                    class="btn btn-outline-secondary rounded-pill">
                    Batal
                </a>
            </div>

        </form>

    </div>

</body>

</html>