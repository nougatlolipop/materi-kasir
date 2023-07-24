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
        $total=0;
        if (count($keranjang)>0) {
            $keranjang = json_decode($keranjang[0]->data)->data;
            
            foreach ($keranjang as $key => $value) {
                $total = $total+((int)$value->jumlah*(int)$value->hargaProduk);
            }
        }else{
            $keranjang=[];
        }

        $data = [
            'title' => 'POS',
            'breadcrumbs' => ['Home', 'POS'],
            'kategori' => $this->modelKategori->findAll(),
            'produk' => $produk->getResult(),
            'keranjang' => $keranjang,
            'total'=>$total
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
            $itemKeranjang['keterangan'] = '';
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
            $itemKeranjang['keterangan'] = '';

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

    public function deleteKeranjang() {
        $id = $this->request->getVar('idProduk');
        $keranjang = $this->modelKeranjang->findAll();
        $keranjang = json_decode($keranjang[0]->data)->data;
        $itemKeranjang = [];

        foreach ($keranjang as $key => $value) {
            if ($value->idProduk !== $id) {
                $itemKeranjang[]=$value;
            }
        }

        $dataUpdate = [
            'data' => json_encode(['data' => $itemKeranjang])
        ];
        $this->modelKeranjang->update(1, $dataUpdate);

        $keranjangNew = $this->modelKeranjang->where(['id' => 1])->findAll();
        echo $keranjangNew[0]->data;
    }

    public function bayarPesanan() {
        $keranjang = $this->modelKeranjang->where(['id' => 1])->findAll();

        if (count($keranjang)==0) {
            echo json_encode(['status'=>false]);
            exit; //program berhenti membaca coding di baris ini
        }

        $keranjang = json_decode($keranjang[0]->data)->data;
        if(count($keranjang)>0){
            echo json_encode(['status'=>true]);
        }else{
            echo json_encode(['status'=>false]);
        };
        
    }

    public function simpanTransaksi() {
        $keranjangRaw = $this->modelKeranjang->where(['id' => 1])->findAll();
        $keranjang = json_decode($keranjangRaw[0]->data)->data;
        $grandTotal=0;
        foreach ($keranjang as $key => $value) {
            $grandTotal=$grandTotal+((int)$value->jumlah*(int)$value->hargaProduk);
        }
        $dataSimpan = [
            'user' => user()->email,
            'grandTotal'=>$grandTotal,
            'cash'=>$this->request->getVar('cash'),
            'item'=>$keranjangRaw[0]->data,
        ];
        dd($dataSimpan);

        //proses simpan

        // simpan kedalam database dengan table transaksi (id,emailKasir,granTotal,cash,item,tanggalBayar)
        // jika berhasil hapus keranjang dan kembali ke halaman pos
    }
}
