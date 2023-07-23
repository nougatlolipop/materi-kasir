<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'idProduk';
    protected $returnType     = 'object';
    protected $allowedFields = ['skuProduk', 'namaProduk','hargaProduk','isReadyProduk','gambarProduk','ketegoriProduk'];

    public function getProduct(){
        $builder =$this->table($this->table);
        $builder->join('kategori','kategori.idKategori='.$this->table.'.kategoriProduk','LEFT');
        // $builder->where([
        //     'isReadyProduk'=>1
        // ]);
        return $builder->get();
    }

    public function getProductPerKategori($kat=null){
        $builder =$this->table($this->table);
        $builder->join('kategori','kategori.idKategori='.$this->table.'.kategoriProduk','LEFT');
        // $builder->where([
        //     'isReadyProduk'=>1,
        // ]);
        if ($kat) {
            $builder->where([
                'kategoriProduk'=>$kat,
            ]);
        }
        return $builder->get();
    }
}