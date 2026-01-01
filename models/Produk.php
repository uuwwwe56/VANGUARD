<?php

require_once __DIR__ . '/../core/QueryBuilder.php';

class Produk extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct('produk');
    }

    /**
     * Ambil semua produk + nama kategori
     */
    public function allWithKategori()
    {
        $sql = "
            SELECT 
                p.*,
                k.nama_kategori
            FROM produk p
            LEFT JOIN kategori k 
                ON p.id_kategori = k.id_kategori
            ORDER BY p.id_produk DESC
        ";

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
