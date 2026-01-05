<?php
require_once '../../../middleware/user.php';
require_once '../../../models/Produk.php';
require_once '../../../models/Testimoni.php';
require_once '../../../models/DetailProduk.php';

$id = $_GET['id'];
$produkModel = new Produk();
$produk = $produkModel->find($id, 'id_produk');

$detailModel = new DetailProduk();
$detail = $detailModel->getByProduk($id);

$testimoniModel = new Testimoni();
$testimoni = $testimoniModel->getByProduk($id); // hanya approved
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - Vanguard</title>
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
    <div class="container py-5">
        <a href="../produk/index.php" class="icon">
            <i class="bi bi-chevron-double-left"></i> Back
        </a>
        <!-- PRODUK UTAMA -->
        <div class="row">

            <!-- GAMBAR -->
            <div class="col-md-4 ms-5 mb-3">
                <img src="../../../assets/img/produk/<?= $produk['gambar'] ?>"
                    class="card-img-top product-image" style="margin-top: 30px;"
                    alt="<?= $produk['nama_produk'] ?>">
            </div>

            <!-- INFO PRODUK -->
            <div class="col-md-7 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">

                        <h3 class="fw-bold"><?= $produk['nama_produk'] ?></h3>

                        <!-- HARGA -->
                        <h4 class="text-primary mb-3">
                            Rp <?= number_format($produk['harga']) ?>
                        </h4>

                        <!-- STOK -->
                        <?php if ($produk['stok'] > 0): ?>
                            <span class="badge bg-success mb-3">Stok tersedia</span>
                        <?php else: ?>
                            <span class="badge bg-danger mb-3">Stok habis</span>
                        <?php endif; ?>

                        <hr>

                        <!-- DETAIL PRODUK -->
                        <h5 class="fw-bold">Detail Produk</h5>

                        <?php if ($detail): ?>
                            <ul class="list-unstyled small">
                                <li class="mb-2"><strong>Deskripsi:</strong><br><?= $detail['deskripsi'] ?></li>
                                <li><strong>Bahan:</strong> <?= $detail['bahan'] ?></li>
                                <li><strong>Ukuran:</strong> <?= $detail['ukuran'] ?></li>
                                <li><strong>Warna:</strong> <?= $detail['warna'] ?></li>
                                <li><strong>Berat:</strong> <?= $detail['berat'] ?></li>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Detail produk belum tersedia.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>

        <!-- TESTIMONI -->
        <div class="row mt-5">
            <div class="col-12">
                <h4 class="fw-bold mb-3">Testimoni Pembeli</h4>

                <?php if (empty($testimoni)): ?>
                    <div class="alert alert-secondary">
                        Belum ada testimoni
                    </div>
                <?php endif; ?>

                <?php foreach ($testimoni as $t): ?>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <strong><?= $t['nama'] ?></strong>
                                <span><?= str_repeat('⭐', $t['rating']) ?></span>
                                <span class="mb-0 mt-2 text-muted">
                                    <?= $t['komentar'] ?>
                                </span>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
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