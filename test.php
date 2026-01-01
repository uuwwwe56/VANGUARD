<?php
require 'config/database.php';

$db = new Database();

if ($db->conn) {
    echo "Koneksi sukses!";
}
