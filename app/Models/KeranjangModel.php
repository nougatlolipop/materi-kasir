<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table      = 'keranjang';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['id','data'];

}