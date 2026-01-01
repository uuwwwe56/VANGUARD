<?php
require_once __DIR__ . '/../core/QueryBuilder.php';

class Testimoni extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct('testimoni');
    }

    // Ambil testimoni berdasarkan produk yang sudah approve
    public function getByProduk($id_produk)
    {
        $sql = "SELECT t.*, u.nama 
                FROM testimoni t
                JOIN users u ON t.id_user = u.id_user
                WHERE t.id_produk = ? AND t.status='approved'
                ORDER BY t.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_produk);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Cek duplikasi testimoni per transaksi
    public function sudahAdaTransaksi($id_transaksi, $id_user)
    {
        $stmt = $this->db->prepare("
        SELECT id_testimoni
        FROM testimoni
        WHERE id_transaksi = ? AND id_user = ?
        LIMIT 1
    ");
        $stmt->bind_param("ii", $id_transaksi, $id_user);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }


    // Cek testimoni per transaksi + produk + user
    public function sudahAda($id_transaksi, $id_produk, $id_user)
    {
        $stmt = $this->db->prepare("
        SELECT id_testimoni
        FROM testimoni
        WHERE id_transaksi = ?
          AND id_produk = ?
          AND id_user = ?
        LIMIT 1
    ");
        $stmt->bind_param("iii", $id_transaksi, $id_produk, $id_user);
        $stmt->execute();

        return $stmt->get_result()->num_rows > 0;
    }

    
    // Insert testimoni
    public function create($data)
    {
        if (!isset($data['status'])) $data['status'] = 'pending';
        return $this->insert($data);
    }

    // Admin approve
    public function approve($id_testimoni)
    {
        $stmt = $this->db->prepare("
            UPDATE testimoni SET status='approved' WHERE id_testimoni=?
        ");
        $stmt->bind_param('i', $id_testimoni);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    // List admin (opsional filter status)
    public function all()
    {
        $sql = "
        SELECT 
            t.id_testimoni,
            t.rating,
            t.komentar,
            t.status,
            u.nama AS nama_user,
            p.nama_produk
        FROM testimoni t
        JOIN users u ON t.id_user = u.id_user
        JOIN produk p ON t.id_produk = p.id_produk
        ORDER BY t.id_testimoni DESC
    ";

        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }


    // Ambil produk dari transaksi
    public function getProdukByTransaksi($id_transaksi)
    {
        $sql = "
        SELECT id_produk
        FROM detail_transaksi
        WHERE id_transaksi = ?
        LIMIT 1
    ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_transaksi);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        return $result ? $result['id_produk'] : null;
    }



    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare(
            "UPDATE testimoni SET status=? WHERE id_testimoni=?"
        );
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    public function masihAdaProdukBelumDitestimoni($id_transaksi, $id_user)
    {
        // total produk di transaksi
        $q1 = $this->db->prepare("
        SELECT COUNT(*) total
        FROM detail_transaksi
        WHERE id_transaksi = ?
    ");
        $q1->bind_param("i", $id_transaksi);
        $q1->execute();
        $total_produk = $q1->get_result()->fetch_assoc()['total'];

        // total testimoni user di transaksi tsb
        $q2 = $this->db->prepare("
        SELECT COUNT(*) total
        FROM testimoni
        WHERE id_transaksi = ? AND id_user = ?
    ");
        $q2->bind_param("ii", $id_transaksi, $id_user);
        $q2->execute();
        $total_testimoni = $q2->get_result()->fetch_assoc()['total'];

        return $total_testimoni < $total_produk;
    }
}
