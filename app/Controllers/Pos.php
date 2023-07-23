<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\KeranjangModel;

class Pos extends BaseController
{
    protected $modelKategori;
    protected $modelProduk;
    protected $modelKeranjang;

    public function __construct()
    {
        $this->modelKategori = new KategoriModel();
        $this->modelProduk = new ProdukModel();
        $this->modelKeranjang = new KeranjangModel();
    }

    public function index()
    {
        $kat = $this->request->getVar('kat');
        if ($kat) {
            $produk = $this->modelProduk->getProductPerKategori($kat);
        } else {
            $produk = $this->modelProduk->getProduct();
        }
        $keranjang=$this->modelKeranjang->findAll();
        $keranjang = json_decode($keranjang[0]->data)->data;
        $data = [
            'title' => 'POS',
            'breadcrumbs' => ['Home', 'POS'],
            'kategori' => $this->modelKategori->findAll(),
            'produk' => $produk->getResult(),
            'keranjang' => $keranjang,
        ];
        return view('pos', $data);
    }

    public function addKeranjang()
    {
        $id = $this->request->getVar('idProduk');

        $produk = $this->modelProduk->where(['idProduk' => $id])->first();
        $keranjang = $this->modelKeranjang->findAll();
        $itemKeranjang = [];
        if (count($keranjang) == 0) {
            foreach ($produk as $key => $value) {
                $itemKeranjang[$key] = $value;
            }
            $itemKeranjang['jumlah'] = 1;
            $dataInsert = [
                'id' => 1,
                'data' => json_encode(['data' => [$itemKeranjang]])
            ];
            $this->modelKeranjang->insert($dataInsert);
        } else {
            $keranjang = json_decode($keranjang[0]->data)->data;

            foreach ($produk as $key => $value) {
                $itemKeranjang[$key] = $value;
            }
            $itemKeranjang['jumlah'] = 1;

            $keranjangNew = array_merge($keranjang, [$itemKeranjang]);
            $jsonKeranjangNew = json_encode(['data' => $keranjangNew]);


            // Decode JSON data into associative array
            $dataArray = json_decode($jsonKeranjangNew, true);

            // Process the data to merge items with the same idProduk and sum their jumlah
            $mergedData = [];
            foreach ($dataArray['data'] as $item) {
                $idProduk = $item['idProduk'];
                if (isset($mergedData[$idProduk])) {
                    $mergedData[$idProduk]['jumlah'] += $item['jumlah'];
                } else {
                    $mergedData[$idProduk] = $item;
                }
            }

            // Reindex array to get sequential keys
            $mergedData = array_values($mergedData);

            $dataUpdate = [
                'data' => json_encode(['data' => $mergedData])
            ];
            $this->modelKeranjang->update(1, $dataUpdate);
        }
        $keranjangNew = $this->modelKeranjang->where(['id' => 1])->findAll();
        echo $keranjangNew[0]->data;

    }
}
