<?php
session_start(); // ⬅️ WAJIB
require_once '../../../middleware/admin.php';
require_once '../../../core/Database.php';

$db = (new Database())->conn;

    $data = $db->query(" SELECT 
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

<?php if (isset($_SESSION['success'])): ?>
    <script>
        alert("<?= $_SESSION['success'] ?>");
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>


<h3>Data Transaksi</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Nama Penerima</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Status & Bukti</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($data as $i => $t): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $t['nama_user'] ?></td>
            <td><?= $t['nama_penerima'] ?></td>
            <td><?= $t['tanggal'] ?></td>
            <td>Rp <?= number_format($t['total']) ?></td>

            <!-- STATUS + BUKTI -->
            <td>
                <strong><?= strtoupper($t['status']) ?></strong>

                <?php if (!empty($t['bukti_transfer'])): ?>
                    <br>
                    <a href="../../../assets/img/bukti/<?= $t['bukti_transfer'] ?>" target="_blank">
                        📷 Lihat Bukti
                    </a>
                <?php endif; ?>
            </td>

            <!-- AKSI -->
            <td>
                <form action="../../../controllers/transaksi_admin.php"
                    method="POST"
                    onsubmit="return confirmUpdate(this)">
                    <input type="hidden" name="id_transaksi" value="<?= $t['id_transaksi'] ?>">

                    <select name="status">
                        <option value="pending">Pending</option>
                        <option value="menunggu_verifikasi">Menunggu Verifikasi</option>
                        <option value="dibayar">Dibayar</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>


                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

<script>
    function confirmUpdate(form) {
        const status = form.querySelector('select[name="status"]').value;
        return confirm(
            "Yakin ingin mengubah status transaksi menjadi \"" + status.toUpperCase() + "\" ?"
        );
    }
</script>