<?php
require_once '../../../middleware/admin.php';
require_once '../../../models/Kategori.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - Vanguard</title>
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

        .product-card {
            max-width: 720px;
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

        .form-label {
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="product-card">

        <h3 class="fw-bold mb-1">
            ➕ Tambah Produk
        </h3>
        <p class="text-muted mb-4">
            Lengkapi data produk yang akan ditampilkan di toko
        </p>

        <form action="../../../controllers/produk.php"
            method="POST"
            enctype="multipart/form-data">

            <!-- NAMA PRODUK -->
            <div class="mb-3">
                <label class="form-label">
                    Nama Produk
                </label>
                <input type="text"
                    name="nama_produk"
                    class="form-control"
                    placeholder="Contoh: Hoodie Oversize"
                    required>
            </div>

            <!-- KATEGORI -->
            <div class="mb-3">
                <label class="form-label">
                    Kategori
                </label>
                <select name="id_kategori"
                    class="form-select"
                    required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = new Kategori();
                    foreach ($kategori->get() as $row):
                    ?>
                        <option value="<?= $row['id_kategori'] ?>">
                            <?= $row['nama_kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- HARGA & STOK -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Harga
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number"
                            name="harga"
                            class="form-control"
                            placeholder="100000"
                            required>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        Stok
                    </label>
                    <input type="number"
                        name="stok"
                        class="form-control"
                        placeholder="10"
                        required>
                </div>
            </div>

            <!-- GAMBAR -->
            <div class="mb-4">
                <label class="form-label">
                    Gambar Produk
                </label>
                <input type="file"
                    name="gambar"
                    class="form-control">
                <small class="text-muted">
                    Format JPG / PNG, maksimal 2MB
                </small>
            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="index.php"
                    class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <button type="submit"
                    name="create"
                    class="btn btn-success rounded-pill px-5">
                    <i class="bi bi-save me-2"></i>
                    Simpan Produk
                </button>
            </div>

        </form>

    </div>

</body>

</html>