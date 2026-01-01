<?php
require '../../models/Kategori.php';
$kategori = new Kategori();
$data = $kategori->get();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Kategori</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
</head>

<body class="p-4">
    <h2>Data Kategori</h2>

    <!-- Form Tambah -->
    <form method="POST" action="../../controllers/kategori.php">
        <input type="text" name="nama_kategori" placeholder="Nama kategori" required>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
    </form>

    <!-- Tabel -->
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['id_kategori']; ?></td>
                <td><?= $row['nama_kategori']; ?></td>
                <td>
                    <a href="#" onclick="editKategori(<?= $row['id_kategori']; ?>,'<?= $row['nama_kategori']; ?>')" class="btn btn-warning btn-sm">Edit</a>
                    <a href="../../controllers/kategori.php?hapus=<?= $row['id_kategori']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function editKategori(id, nama) {
            const newNama = prompt('Edit nama kategori', nama);
            if (newNama != null) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../../controllers/kategori.php';
                form.innerHTML = `
            <input type="hidden" name="id_kategori" value="${id}">
            <input type="hidden" name="nama_kategori" value="${newNama}">
            <input type="hidden" name="edit" value="1">
        `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>

</html>