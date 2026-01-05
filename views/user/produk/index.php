<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Produk.php';

$model = new Produk();
$produk = $model->allWithKategori();
$produkPerKategori = [];

foreach ($produk as $p) {
    $produkPerKategori[$p['nama_kategori']][] = $p;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Vanguard</title>
    <link rel="icon" type="image/png" href="../../../assets/img/Home/L_Vg.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../../assets/css/dasboard.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>


    <!-- PRODUK -->
    <div class="container-fluid py-5" id="produk">
        <div class="container py-4">

            <div class="headlink">
                <a href="../dashboard.php" class="icon">
                    <i class="bi bi-chevron-double-left"></i> Back
                </a>
                <a href="../keranjang/index.php" class="icon">
                    <i class="bi bi-cart fs-2"></i><i class="bi bi-caret-right fs-3"></i>
                </a>
            </div>

            <h3 class="mb-2 text-center mt-5 fs-2 fw-bold">Produk</h3>

            <?php foreach ($produkPerKategori as $kategori => $items): ?>

                <!-- KATEGORI -->
                <div id="<?= strtolower(str_replace(' ', '-', $kategori)) ?>">
                    <h2 class="text-center pb-1 font-monospace">
                        <?= $kategori ?>
                    </h2>

                    <div class="row">
                        <div class="card-slider produk d-flex overflow-auto gap-3 pb-3">

                            <?php foreach ($items as $p): ?>
                                <div class="col-lg-3 col-md-4 col-6 HP my-4">
                                    <div class="card card-hover-scale">

                                        <!-- GAMBAR -->
                                        <img src="../../../assets/img/produk/<?= $p['gambar'] ?>"
                                            class="card-img-top"
                                            alt="<?= $p['nama_produk'] ?>">

                                        <div class="card-body d-flex flex-column">

                                            <!-- NAMA PRODUK -->
                                            <p class="mb-1">
                                                <span class="fs-6 fw-bold"><?= $p['nama_produk'] ?></span><br>
                                                <small class="text-muted"><?= $p['nama_kategori'] ?></small>
                                            </p>

                                            <!-- HARGA -->
                                            <div class="mb-1">
                                                <span class="fw-bold text-dark">
                                                    Rp <?= number_format($p['harga']) ?>
                                                </span>
                                            </div>

                                            <!-- STOK -->
                                            <p class="mt-2 mb-2 small">
                                                <?php if ($p['stok'] > 0): ?>
                                                    <span class="text-success">Stok tersedia</span>
                                                <?php else: ?>
                                                    <span class="text-danger">Stok habis</span>
                                                <?php endif; ?>
                                            </p>

                                            <?php if ($p['stok'] > 0): ?>
                                                <!-- FORM KERANJANG -->
                                                <form action="../../../controllers/keranjang.php"
                                                    method="POST"
                                                    class="mb-2">

                                                    <input type="hidden" name="id_produk"
                                                        value="<?= $p['id_produk'] ?>">

                                                    <input type="number"
                                                        name="qty"
                                                        min="1"
                                                        max="<?= $p['stok'] ?>"
                                                        class="form-control form-control-sm mb-2"
                                                        placeholder="Jumlah"
                                                        required>

                                                    <select name="ukuran"
                                                        class="form-select form-select-sm mb-2"
                                                        required>
                                                        <option value="">Pilih Ukuran</option>
                                                        <option value="S">S</option>
                                                        <option value="M">M</option>
                                                        <option value="L">L</option>
                                                        <option value="XL">XL</option>
                                                    </select>

                                                    <button type="submit"
                                                        name="add_cart"
                                                        class="btn btn-warning btn-sm w-100">
                                                        ➕ Keranjang
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <!-- BUTTON -->
                                            <div class="mt-auto">
                                                <a href="detail.php?id=<?= $p['id_produk'] ?>"
                                                    class="btn btn-outline-secondary btn-sm w-100 mb-2">
                                                    Detail
                                                </a>

                                                <!-- <?php if ($p['stok'] > 0): ?>
                                                    <a href="../keranjang/index.php"
                                                        class="btn btn-primary btn-sm w-100">
                                                        Beli
                                                    </a>
                                                <?php endif; ?> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="../../../assets/js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1500,

        });
    </script>
</body>

</html>