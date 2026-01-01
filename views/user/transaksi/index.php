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

<h3>Transaksi Saya</h3>

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Nama Penerima</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Pembayaran</th>
        <th>Status</th>

    </tr>
    

    <?php foreach ($data as $i => $t): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $t['tanggal'] ?></td>
            <td>Rp <?= number_format($t['total']) ?></td>
            <td><?= $t['nama'] ?></td>
            <td><?= $t['alamat'] ?></td>
            <td><?= $t['no_hp'] ?></td>

            <td>
                <?= strtoupper($t['metode_pembayaran']) ?>

                <?php if ($t['metode_pembayaran'] === 'DANA'): ?>
                    <br>
                    <small style="color:#555">
                        Transfer ke DANA 086287361893
                    </small>
                    <form action="../../../controllers/transaksi.php"
                        method="POST"
                        enctype="multipart/form-data"
                        style="margin-top:5px">

                        <input type="hidden" name="id_transaksi"
                            value="<?= $t['id_transaksi'] ?>">

                        <input type="file" name="bukti_transfer" required>
                        <button type="submit" name="upload_bukti">
                            Upload Bukti
                        </button>
                    </form>
                <?php endif; ?>
            </td>

            <td>
    <?php
    switch ($t['status']) {
        case 'pending':
            echo '<span style="color:orange">Pending</span>';
            break;
        case 'menunggu_verifikasi':
            echo '<span style="color:blue">Menunggu Verifikasi</span>';
            break;
        case 'dibayar':
            echo '<span style="color:green">Dibayar</span>';
            break;
        case 'dikirim':
            echo '<span style="color:purple">Dikirim</span>';
            break;
            case 'selesai':
                echo '<span style="color:darkgreen">Selesai</span>';

                if (!$testimoniModel->sudahAdaTransaksi($t['id_transaksi'], $id_user)) {
                    echo '<br>
        <a href="../testimoni/create.php?id_transaksi=' . $t['id_transaksi'] . '">
            ✍️ Beri Testimoni
        </a>';
                } else {
                    echo '<br><small style="color:#999">Testimoni sudah dikirim</small>';
                }
                break;
            }
    ?>
</td>

        </tr>
    <?php endforeach; ?>
</table>


<?php if (isset($_GET['testimoni'])): ?>

<?php
$id_transaksi = (int) $_GET['testimoni'];

// ambil produk transaksi
$produk = $db->query("
    SELECT dt.id_produk, p.nama_produk
    FROM detail_transaksi dt
    JOIN produk p ON dt.id_produk = p.id_produk
    WHERE dt.id_transaksi = $id_transaksi
")->fetch_all(MYSQLI_ASSOC);
?>

<h3>Beri Testimoni</h3>

<?php foreach ($produk as $p): ?>
    <h4><?= $p['nama_produk'] ?></h4>

    <form action="../../../controllers/testimoni.php" method="POST">
        <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
        <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">

        <select name="rating" required>
            <option value="5">⭐⭐⭐⭐⭐</option>
            <option value="4">⭐⭐⭐⭐</option>
            <option value="3">⭐⭐⭐</option>
            <option value="2">⭐⭐</option>
            <option value="1">⭐</option>
        </select>

        <br><br>
        <textarea name="komentar" required></textarea>
        <br><br>

        <button type="submit" name="kirim">Kirim</button>
    </form>
    <hr>
<?php endforeach; ?>

<?php endif; ?>
