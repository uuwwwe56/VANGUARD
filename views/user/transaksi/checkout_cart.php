<?php
require_once '../../../middleware/user.php';
require_once '../../../core/Database.php';

$db = (new Database())->conn;
$id_user = $_SESSION['id_user'];

/* ================= AMBIL DATA KERANJANG ================= */
$data = $db->query("
    SELECT 
        k.id_keranjang,
        k.qty,
        k.ukuran,
        p.id_produk,
        p.nama_produk,
        p.harga,
        p.gambar,
        (k.qty * p.harga) AS subtotal
    FROM keranjang k
    JOIN produk p ON k.id_produk = p.id_produk
    WHERE k.id_user = '$id_user'
");

if ($data->num_rows === 0) {
    die("Keranjang kosong");
}

/* ================= HITUNG TOTAL ================= */
$total = 0;
$items = [];
foreach ($data as $k) {
    $total += $k['subtotal'];
    $items[] = $k;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout Keranjang</title>
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
            max-width: 820px;
            margin: 70px auto;
            background: #ffffff;
            padding: 36px;
            border-radius: 24px;
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

        .item-row {
            border-bottom: 1px dashed #e5e7eb;
            padding: 14px 0;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .price {
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
        <a href="../keranjang/index.php" class="btn btn-link text-decoration-none fw-semibold">
            <i class="bi bi-chevron-double-left me-1"></i> Back
        </a>
    </div>
    <div class="checkout-card">

        <h3 class="fw-bold mb-1">
            🛒 Checkout Keranjang
        </h3>
        <p class="text-muted mb-4">
            Periksa pesanan dan lengkapi data pengiriman
        </p>

        <!-- LIST PRODUK -->
        <div class="mb-4">
            <?php foreach ($items as $k): ?>
                <input type="hidden" name="produk_id[]" value="<?= $k['id_produk'] ?>">
                <input type="hidden" name="qty[]" value="<?= $k['qty'] ?>">
                <input type="hidden" name="ukuran[]" value="<?= $k['ukuran'] ?>">

                <div class="item-row d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold"><?= $k['nama_produk'] ?></div>
                        <small class="text-muted">
                            <?= $k['qty'] ?> pcs
                            <?= $k['ukuran'] ? "| Ukuran: " . $k['ukuran'] : "" ?>
                        </small>
                    </div>
                    <div class="price">
                        Rp <?= number_format($k['subtotal']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- TOTAL -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="fw-bold fs-5">Total Pembayaran</span>
            <span class="fw-bold fs-4 text-success">
                Rp <?= number_format($total) ?>
            </span>
        </div>

        <!-- FORM -->
        <form action="../../../controllers/transaksi.php" method="POST">

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
                    name="checkout_cart"
                    class="btn btn-success btn-lg rounded-pill">
                    <i class="bi bi-cart-check me-2"></i>
                    Bayar Semua
                </button>

                <a href="../keranjang/index.php"
                    class="btn btn-outline-secondary rounded-pill">
                    Kembali ke Keranjang
                </a>
            </div>

        </form>

    </div>

</body>

</html>