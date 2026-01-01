<?php
require_once __DIR__ . '/../core/Database.php';

class DetailProduk extends Database
{

    public function getByProduk($id_produk)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM detail_produk WHERE id_produk = ?"
        );
        $stmt->bind_param("i", $id_produk);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO detail_produk (id_produk, deskripsi, bahan, ukuran)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "isss",
            $data['id_produk'],
            $data['deskripsi'],
            $data['bahan'],
            $data['ukuran']
        );
        return $stmt->execute();
    }

    public function update($id_produk, $data)
    {
        $stmt = $this->conn->prepare(
            "UPDATE detail_produk 
             SET deskripsi=?, bahan=?, ukuran=?
             WHERE id_produk=?"
        );
        $stmt->bind_param(
            "sssi",
            $data['deskripsi'],
            $data['bahan'],
            $data['ukuran'],
            $id_produk
        );
        return $stmt->execute();
    }

    public function delete($id_produk)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM detail_produk WHERE id_produk=?"
        );
        $stmt->bind_param("i", $id_produk);
        return $stmt->execute();
    }
}
