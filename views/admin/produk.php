<?php
require '../../models/Produk.php';
require '../../models/Kategori.php';

$produk = new Produk();
$kategori = new Kategori();

$dataProduk = $produk->get();
$dataKategori = $kategori->get();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Produk</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body class="p-4">
    <h2>Data Produk</h2>

    <!-- Form Tambah -->
    <form method="POST" action="../../controllers/produk.php">
        <input type="text" name="nama_produk" placeholder="Nama Produk" required>
        <input type="text" name="brand" placeholder="Brand">
        <input type="number" name="harga" placeholder="Harga" required>
        <input type="number" name="stok" placeholder="Stok" required>
        <input type="text" name="gambar" placeholder="Nama file gambar">
        <select name="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($dataKategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Tabel Produk -->
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Produk</th>
            <th>Brand</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($dataProduk as $p): ?>
            <tr>
                <td><?= $p['id_produk']; ?></td>
                <td><?= $p['nama_produk']; ?></td>
                <td><?= $p['daftar_produk'] ?></td>
                <td><?= $p['brand']; ?></td>
                <td><?= $p['harga']; ?></td>
                <td><?= $p['stok']; ?></td>
                <td>
                    <?php
                    $kat = $kategori->find($p['id_kategori'], 'id_kategori');
                    echo $kat ? $kat['nama_kategori'] : '-';
                    ?>
                </td>
                <td>
                    <a href="#" onclick="editProduk(<?= $p['id_produk']; ?>,'<?= $p['nama_produk']; ?>','<?= $p['brand']; ?>','<?= $p['harga']; ?>','<?= $p['stok']; ?>','<?= $p['id_kategori']; ?>','<?= $p['gambar']; ?>')" class="btn btn-warning btn-sm">Edit</a>
                    <a href="../../controllers/produk.php?hapus=<?= $p['id_produk']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function editProduk(id, nama, brand, harga, stok, kategori, gambar) {
            const newNama = prompt("Nama Produk", nama);
            const newBrand = prompt("Brand", brand);
            const newHarga = prompt("Harga", harga);
            const newStok = prompt("Stok", stok);
            const newKategori = prompt("ID Kategori", kategori);
            const newGambar = prompt("Nama File Gambar", gambar);

            if (newNama != null) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../../controllers/produk.php';
                form.innerHTML = `
            <input type="hidden" name="id_produk" value="${id}">
            <input type="hidden" name="nama_produk" value="${newNama}">
            <input type="hidden" name="brand" value="${newBrand}">
            <input type="hidden" name="harga" value="${newHarga}">
            <input type="hidden" name="stok" value="${newStok}">
            <input type="hidden" name="id_kategori" value="${newKategori}">
            <input type="hidden" name="gambar" value="${newGambar}">
            <input type="hidden" name="edit" value="1">
        `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>

</html>