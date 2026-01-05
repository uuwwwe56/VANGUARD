<?php
session_start();
require_once '../../../middleware/admin.php';
require_once '../../../core/Database.php';

$db = (new Database())->conn;

$data = $db->query("
    SELECT 
        t.id_transaksi,
        t.tanggal,
        t.total,
        t.nama AS nama_penerima,
        t.alamat,
        t.no_hp,
        t.metode_pembayaran,
        t.status,
        t.bukti_transfer,
        u.nama AS nama_user
    FROM transaksi t
    JOIN users u ON t.id_user = u.id_user
    ORDER BY t.id_transaksi DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
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

        .card {
            border-radius: 18px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, .3);
        }

        .icon {
            text-decoration: none;
            font-weight: 500;
            font-size: 20px;
            color: aliceblue;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <a href="../dashboard.php" class="icon">
            <i class="bi bi-chevron-double-left"></i> Back
        </a>
        <hr>
        <div class="card p-4">
            <h4 class="fw-bold mb-4">
                💳 Data Transaksi
            </h4>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Penerima</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status & Bukti</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $i => $t): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= $t['nama_user'] ?></td>
                                <td><?= $t['nama_penerima'] ?></td>
                                <td><?= $t['tanggal'] ?></td>
                                <td class="fw-semibold">
                                    Rp <?= number_format($t['total']) ?>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <span class="badge bg-secondary text-uppercase">
                                        <?= $t['status'] ?>
                                    </span>

                                    <?php if (!empty($t['bukti_transfer'])): ?>
                                        <br>
                                        <a href="../../../assets/img/bukti/<?= $t['bukti_transfer'] ?>"
                                            target="_blank"
                                            class="text-decoration-none text-primary small">
                                            <i class="bi bi-image"></i> Lihat Bukti
                                        </a>
                                    <?php endif; ?>
                                </td>

                                <!-- AKSI -->
                                <td>
                                    <form action="../../../controllers/transaksi_admin.php"
                                        method="POST"
                                        class="d-flex gap-2"
                                        onsubmit="return confirmUpdate(this)">

                                        <input type="hidden"
                                            name="id_transaksi"
                                            value="<?= $t['id_transaksi'] ?>">

                                        <select name="status"
                                            class="form-select form-select-sm">
                                            <option value="pending">Pending</option>
                                            <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                                            <option value="dibayar">Dibayar</option>
                                            <option value="dikirim">Dikirim</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="batal">Batal</option>
                                        </select>

                                        <button type="submit"
                                            name="update_status"
                                            class="btn btn-sm btn-success rounded-pill px-3">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function confirmUpdate(form) {
            const status = form.querySelector('select').value;
            return confirm(
                'Yakin ingin mengubah status menjadi "' + status.toUpperCase() + '" ?'
            );
        }
    </script>

</body>

</html>