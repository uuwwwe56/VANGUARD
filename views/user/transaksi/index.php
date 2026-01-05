<?php
require_once '../../../middleware/user.php';
require_once '../../../core/Database.php';
require_once '../../../models/Testimoni.php';

$testimoniModel = new Testimoni();
$db = (new Database())->conn;
$id_user = $_SESSION['id_user'];

$data = $db->query("
    SELECT *
    FROM transaksi
    WHERE id_user = '$id_user'
    ORDER BY id_transaksi DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Vanguard</title>
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
        body {
            background-color: navy;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 24px;
            color: aliceblue;
        }

        .table-wrapper {
            background: #fff;
            padding: 22px;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
        }

        .table th {
            background: #0f172a;
            color: #fff;
            font-size: 14px;
        }

        .table td {
            vertical-align: middle;
            font-size: 14px;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background: #fde68a;
            color: #92400e;
        }

        .badge-verifikasi {
            background: #bfdbfe;
            color: #1e3a8a;
        }

        .badge-dibayar {
            background: #bbf7d0;
            color: #065f46;
        }

        .badge-dikirim {
            background: #ddd6fe;
            color: #5b21b6;
        }

        .badge-selesai {
            background: #86efac;
            color: #14532d;
        }

        .upload-box {
            background: #f8fafc;
            padding: 10px;
            border-radius: 10px;
            margin-top: 8px;
        }

        .testimoni-box {
            background: #ffffff;
            padding: 24px;
            border-radius: 18px;
            margin-top: 40px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <a href="../dashboard.php" class="icon">
            <i class="bi bi-chevron-double-left"></i> Back
        </a>
        <h3 class="page-title mt-4">
            <i class="bi bi-receipt"></i> Transaksi Saya
        </h3>

        <div class="table-wrapper">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Penerima</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data as $i => $t): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $t['tanggal'] ?></td>
                            <td class="fw-bold text-success">
                                Rp <?= number_format($t['total']) ?>
                            </td>
                            <td><?= $t['nama'] ?></td>
                            <td><?= $t['alamat'] ?></td>
                            <td><?= $t['no_hp'] ?></td>

                            <td>
                                <strong><?= strtoupper($t['metode_pembayaran']) ?></strong>

                                <?php if ($t['metode_pembayaran'] === 'DANA'): ?>
                                    <div class="upload-box">
                                        <small class="text-muted d-block">
                                            Transfer ke DANA <b>086287361893</b>
                                        </small>

                                        <form action="../../../controllers/transaksi.php"
                                            method="POST"
                                            enctype="multipart/form-data">

                                            <input type="hidden" name="id_transaksi"
                                                value="<?= $t['id_transaksi'] ?>">

                                            <input type="file"
                                                name="bukti_transfer"
                                                class="form-control form-control-sm mb-2"
                                                required>

                                            <button type="submit"
                                                name="upload_bukti"
                                                class="btn btn-sm btn-primary w-100">
                                                Upload Bukti
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php
                                switch ($t['status']) {
                                    case 'pending':
                                        echo '<span class="badge-status badge-pending">Pending</span>';
                                        break;

                                    case 'menunggu_verifikasi':
                                        echo '<span class="badge-status badge-verifikasi">Menunggu Verifikasi</span>';
                                        break;

                                    case 'dibayar':
                                        echo '<span class="badge-status badge-dibayar">Dibayar</span>';
                                        break;

                                    case 'dikirim':
                                        echo '<span class="badge-status badge-dikirim">Dikirim</span>';
                                        break;

                                    case 'selesai':
                                        echo '<span class="badge-status badge-selesai">Selesai</span>';

                                        if (!$testimoniModel->sudahAdaTransaksi($t['id_transaksi'], $id_user)) {
                                            echo '<br>
                                    <a href="../testimoni/create.php?id_transaksi=' . $t['id_transaksi'] . '"
                                       class="btn btn-link p-0 mt-1">
                                       ✍️ Beri Testimoni
                                    </a>';
                                        } else {
                                            echo '<br><small class="text-muted">Testimoni sudah dikirim</small>';
                                        }
                                        break;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_GET['testimoni'])): ?>
            <?php
            $id_transaksi = (int) $_GET['testimoni'];
            $produk = $db->query("
            SELECT dt.id_produk, p.nama_produk
            FROM detail_transaksi dt
            JOIN produk p ON dt.id_produk = p.id_produk
            WHERE dt.id_transaksi = $id_transaksi
        ")->fetch_all(MYSQLI_ASSOC);
            ?>

            <div class="testimoni-box">
                <h3>⭐ Beri Testimoni</h3>

                <?php foreach ($produk as $p): ?>
                    <h5><?= $p['nama_produk'] ?></h5>

                    <form action="../../../controllers/testimoni.php" method="POST" class="mb-4">
                        <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                        <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">

                        <select name="rating" class="form-select mb-2" required>
                            <option value="5">⭐⭐⭐⭐⭐</option>
                            <option value="4">⭐⭐⭐⭐</option>
                            <option value="3">⭐⭐⭐</option>
                            <option value="2">⭐⭐</option>
                            <option value="1">⭐</option>
                        </select>

                        <textarea name="komentar"
                            class="form-control mb-3"
                            placeholder="Tulis pengalaman kamu..."
                            required></textarea>

                        <button type="submit" name="kirim" class="btn btn-success">
                            Kirim Testimoni
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>