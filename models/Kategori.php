<?php
require_once __DIR__ . '/../core/QueryBuilder.php';

class Kategori extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct('kategori');
    }
}
