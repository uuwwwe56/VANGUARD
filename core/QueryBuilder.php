<?php
require_once __DIR__ . '/Database.php';

class QueryBuilder
{
    protected $db;
    protected $table;

    public function __construct($table)
    {
        $this->db = (new Database())->conn;
        $this->table = $table;
    }

    public function get()
    {
        $result = $this->db->query("SELECT * FROM $this->table");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id, $pk = 'id')
    {
        $result = $this->db->query(
            "SELECT * FROM $this->table WHERE $pk='$id'"
        );
        return $result->fetch_assoc();
    }

    public function insert($data)
    {
        // Ambil kolom dan placeholder
        $columns = implode(",", array_keys($data));
        $placeholders = implode(",", array_fill(0, count($data), '?'));

        // Siapkan statement
        $stmt = $this->db->prepare("INSERT INTO $this->table ($columns) VALUES ($placeholders)");

        if (!$stmt) {
            die("SQL ERROR: " . $this->db->error);
        }

        // Tentukan tipe data untuk bind_param (misal semua string 's')
        $types = str_repeat('s', count($data));
        $stmt->bind_param($types, ...array_values($data));

        // Eksekusi
        if (!$stmt->execute()) {
            die("SQL ERROR: " . $stmt->error);
        }

        return true;
    }



    public function update($id, $data, $pk = 'id')
    {
        $set = '';
        foreach ($data as $key => $val) {
            $val = $this->db->real_escape_string($val);
            $set .= "$key='$val',";
        }
        $set = rtrim($set, ',');

        return $this->db->query(
            "UPDATE $this->table SET $set WHERE $pk='$id'"
        );
    }


    public function delete($id, $pk = 'id')
    {
        return $this->db->query(
            "DELETE FROM $this->table WHERE $pk='$id'"
        );
    }
}
