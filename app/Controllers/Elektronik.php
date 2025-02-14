<?php

namespace App\Controllers;

use App\Entities\ElektronikEntity;
use App\Models\ProductElektronikModel;
use App\Models\ElektronikModel;

class Elektronik extends BaseController
{

    private $db;

    public function __construct()
    {
        // Koneksi manual ke MySQLi
        $this->db = new \mysqli('localhost', 'root', '12345', 'dika');

        if ($this->db->connect_error) {
            die("Koneksi Gagal: " . $this->db->connect_error);
        }
    }

    public function index()
    {
        $type = 'elektronik';
        $sql = "SELECT * FROM product WHERE type = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $type);
        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new ElektronikEntity($row);
            $products[] = $product;
        }


        $data = [
            'title' => 'Electronic Product',
            'products' => $products
        ];
        return view('elektronik/index', $data);
    }


    // 🔥 Ambil User Berdasarkan ID
    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();

        return $product ? new ElektronikEntity($product) : null;
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Produk Elektronik',
        ];

        return view('elektronik/add-product', $data);
    }

    public function save()
    {
        $nama = $this->request->getVar('nama');
        $harga = $this->request->getVar('harga');
        $type = 'elektronik';
        $isBaterai = ($this->request->getVar('is_baterai') == "true" ? true : false);
        $aliranListrik = $this->request->getVar('aliran_listrik');

        $sql = "INSERT INTO product (nama, harga, type, is_baterai, aliran_listrik) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sisii", $nama, $harga, $type, $isBaterai, $aliranListrik);
        $stmt->execute();

        return redirect()->to('/elektronik');
    }

    public function edit($id)
    {

        $product = $this->getUserById($id);

        $data = [
            'title' => 'Edit Elektronik Product',
            'product' => $product
        ];

        return view('/elektronik/edit-product', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $nama = $this->request->getVar('nama');
        $harga = $this->request->getVar('harga');
        $type = 'elektronik';
        $isBaterai = ($this->request->getVar('is_baterai') == "true" ? true : false);
        $aliranListrik = $this->request->getVar('aliran_listrik');

        $stmt = $this->db->prepare("UPDATE product SET nama = ?, harga = ?, type = ?, is_baterai = ?, aliran_listrik = ? WHERE id = ?");
        $stmt->bind_param("sisiii", $nama, $harga, $type, $isBaterai, $aliranListrik, $id);
        $stmt->execute();
        $stmt->close();

        return redirect()->to('/elektronik');
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM product WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();


        return redirect()->to('/elektronik');
    }


    public function product()
    {
        return view('elektronik/index');
    }
}
