<?php

namespace App\Controllers;

use App\Entities\ElektronikEntity;
use App\Models\ProductElektronikModel;
use App\Models\ElektronikModel;

class Elektronik extends BaseController
{

    protected $productElektronik;

    public function __construct()
    {
        $this->productElektronik = new ElektronikModel();
    }

    public function index()
    {
        $products = $this->productElektronik->getAllElectronicProduct(); // Now returns an array of UserEntity objects


        $data = [
            'title' => 'Electronic Product',
            'products' => $products
        ];
        return view('elektronik/index', $data);
    }

    public function create(){
        $data = [
            'title' => 'Form Tambah Produk Elektronik',
        ];

        return view('elektronik/add-product', $data);
    }

    public function save(){
        // dd($this->request->getVar());

        $payload = new ElektronikEntity();
        $payload->fill($this->request->getVar());
        $payload->setIsBaterai(($this->request->getVar('is_baterai') == "true" ? true : false));

        $this->productElektronik->save($payload);

        return redirect()->to('/elektronik');
    }

    public function edit($id){

        $product = $this->productElektronik->getElectronicProductById($id);

        $data = [
            'title' => 'Edit Elektronik Product',
            'product' => $product
        ];

        return view('/elektronik/edit-product', $data);
    }

    public function update(){
        $payload = new ElektronikEntity();
        $payload->fill($this->request->getVar());
        $payload->setIsBaterai(($this->request->getVar('is_baterai') == "true" ? true : false));

        $this->productElektronik->save($payload);

        return redirect()->to('/elektronik');
    }

    public function delete($id){
        $this->productElektronik->deleteById($id);

        return redirect()->to('/elektronik'); 
    }


    public function product() {
        return view('elektronik/index');
    }
}
