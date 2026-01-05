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

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang-Vanguard</title>
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../assets/css/dasboard.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .cart-title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .cart-empty {
            background: #f8fafc;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
        }

        .btn-back {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 18px;
            background: #2563eb;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
        }

        .cart-container {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 80px 1fr 80px 140px 60px;
            gap: 16px;
            align-items: center;
            padding: 14px;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .cart-img img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 10px;
            background: #f1f5f9;
        }

        .cart-info h4 {
            margin: 0;
            font-size: 16px;
        }

        .cart-info p {
            margin: 4px 0;
            font-size: 13px;
            color: #64748b;
        }

        .cart-qty {
            text-align: center;
        }

        .cart-subtotal {
            font-weight: 700;
            color: #0f172a;
        }

        .cart-action button {
            border: none;
            background: #fee2e2;
            color: #b91c1c;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
        }

        .cart-action button:hover {
            background: #fecaca;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* ⭐ BIAR SEJAJAR TENGAH */
            padding: 18px 22px;
            font-size: 18px;
            font-weight: 700;

            color: #fff;
            border-radius: 14px;
        }

        .cart-total .total-text {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>
    <p></p>
    <a href="../produk/index.php" class="icon">
        <i class="bi bi-chevron-double-left mt-5" style="margin-left: 20px;"></i> Back
    </a>
    <?php if ($data->num_rows === 0): ?>
        <div class="cart-empty">
            <p>Keranjang masih kosong.</p>
            <a href="../produk/index.php" class="btn-back">⬅️ Mulai Belanja</a>
        </div>

    <?php else: ?>

        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    
                    <h3 class="cart-title mb-4">🛒 Keranjang Saya</h3>

                    <?php if ($data->num_rows === 0): ?>
                        <div class="cart-empty">
                            <p>Keranjang masih kosong.</p>
                            <a href="../produk/index.php" class="btn-back">
                                ⬅️ Mulai Belanja
                            </a>
                        </div>
                    <?php else: ?>

                        <div class="cart-container">

                            <?php foreach ($data as $k): ?>
                                <?php $total += $k['subtotal']; ?>

                                <div class="cart-item">
                                    <div class="cart-img">
                                        <img src="../../../assets/img/produk/<?= $k['gambar'] ?>">
                                    </div>

                                    <div class="cart-info">
                                        <h4><?= $k['nama_produk'] ?></h4>
                                        <p>Ukuran: <strong><?= $k['ukuran'] ?></strong></p>
                                        <p>Harga: Rp <?= number_format($k['harga']) ?></p>
                                    </div>

                                    <div class="cart-qty">
                                        <span>Qty</span>
                                        <strong><?= $k['qty'] ?></strong>
                                    </div>

                                    <div class="cart-subtotal">
                                        Rp <?= number_format($k['subtotal']) ?>
                                    </div>

                                    <div class="cart-action">
                                        <button onclick="hapusItem(<?= $k['id_keranjang'] ?>)">🗑️</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- TOTAL -->
                            <div class="cart-total mt-4">

                                <div class="total-text">
                                    <span>Total</span>
                                    <strong>Rp <?= number_format($total) ?></strong>
                                </div>

                                <form action="../transaksi/checkout_cart.php" method="POST" class="m-0">
                                    <button type="submit"
                                        name="checkout_cart"
                                        class="btn btn-success btn-lg rounded-pill shadow">
                                        <i class="bi bi-cart-check me-2 fs-5"></i>
                                        Checkout Semua
                                    </button>
                                </form>

                            </div>

                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    <?php endif; ?>


    <script>
        function hapusItem(id) {
            if (!confirm('Yakin ingin menghapus item ini dari keranjang?')) {
                return;
            }

            fetch("../../../controllers/keranjang.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "hapus=1&id_keranjang=" + id
                })
                .then(res => res.text())
                .then(res => {
                    if (res.trim() === 'success') {
                        alert('Item berhasil dihapus');
                        location.reload(); // tetap di halaman keranjang
                    } else {
                        alert('Gagal menghapus item');
                    }
                })
                .catch(() => {
                    alert('Terjadi kesalahan koneksi');
                });
        }
    </script>
</body>

</html>