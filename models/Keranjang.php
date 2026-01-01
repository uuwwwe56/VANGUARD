<?php
require_once __DIR__ . '/../core/Database.php';

class Keranjang
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conn;
    }

    // cek produk + ukuran
    public function findItem($id_user, $id_produk, $ukuran)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM keranjang
            WHERE id_user = ? AND id_produk = ? AND ukuran = ?
        ");
        $stmt->bind_param("iis", $id_user, $id_produk, $ukuran);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    public function insert($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO keranjang (id_user, id_produk, ukuran, qty)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "iisi",
            $data['id_user'],
            $data['id_produk'],
            $data['ukuran'],
            $data['qty']
        );
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function updateQty($id_keranjang, $qty)
    {
        $stmt = $this->db->prepare("
            UPDATE keranjang SET qty = qty + ?
            WHERE id_keranjang = ?
        ");
        $stmt->bind_param("ii", $qty, $id_keranjang);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function getByUser($id_user)
    {
        $stmt = $this->db->prepare("
            SELECT k.*, p.nama_produk, p.harga, p.gambar
            FROM keranjang k
            JOIN produk p ON k.id_produk = p.id_produk
            WHERE k.id_user = ?
        ");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function clearByUser($id_user)
    {
        $stmt = $this->db->prepare("DELETE FROM keranjang WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }
}
