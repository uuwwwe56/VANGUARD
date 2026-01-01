<?php
require_once __DIR__ . '/../core/QueryBuilder.php';

class Transaksi extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct('transaksi');
    }

    // Buat transaksi (return id)
    public function create($data)
    {
        return $this->insert($data);
    }

    // Detail transaksi
    public function insertDetail($data)
    {
        $columns = implode(',', array_keys($data));
        $values  = implode("','", array_map([$this->db, 'real_escape_string'], array_values($data)));

        $sql = "INSERT INTO detail_transaksi ($columns) VALUES ('$values')";
        return $this->db->query($sql);
    }

    // Update stok
    public function updateStok($id_produk, $stok_baru)
    {
        return $this->db->query(
            "UPDATE produk SET stok=$stok_baru WHERE id_produk=$id_produk"
        );
    }

    // Update status + bukti transfer
    public function updateStatusDanBukti($id, $status, $bukti)
    {
        $stmt = $this->db->prepare(
            "UPDATE transaksi SET status=?, bukti_transfer=? WHERE id_transaksi=?"
        );
        $stmt->bind_param("ssi", $status, $bukti, $id);
        $stmt->execute();
    }

    // Update status saja
    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare(
            "UPDATE transaksi SET status=? WHERE id_transaksi=?"
        );
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    // Ambil transaksi + id_produk (UNTUK VIEW USER)
    public function getTransaksiUser($id_user)
    {
        $sql = "
        SELECT 
            t.*,
            dt.id_produk
        FROM transaksi t
        JOIN detail_transaksi dt 
            ON t.id_transaksi = dt.id_transaksi
        WHERE t.id_user = $id_user
        ORDER BY t.created_at DESC
    ";

        return $this->db->query($sql);
    }
}
