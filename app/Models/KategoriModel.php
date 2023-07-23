<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'idKategori';
    protected $returnType     = 'object';
    protected $allowedFields = ['namaKategori', 'iconKategori','colorKategori','slugKategori'];
}