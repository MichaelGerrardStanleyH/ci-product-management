<?php

namespace App\Controllers;

use App\Entities\ElektronikEntity;
use App\Entities\FashionEntity;
use App\Models\ProductElektronikModel;
use App\Models\ElektronikModel;
use Exception;

class Fashion extends BaseController
{

    private $db;

    public function __construct()
    {
        // Koneksi manual ke MySQLi
        $this->db = new \mysqli('localhost', 'root', '12345', 'ci4');

        if ($this->db->connect_error) {
            die("Koneksi Gagal: " . $this->db->connect_error);
        }
    }

    public function index()
    {
        try {
            $sql = "SELECT * FROM fashion_product e INNER JOIN base_product b ON e.id_base_product=b.id_base_product;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new FashionEntity($row);
            $products[] = $product;
        }

        $data = [
            'title' => 'Fashion Product',
            'products' => $products
        ];
        return view('/fashion/index', $data);
    }


    // 🔥 Ambil User Berdasarkan ID
    public function getProductById($id)
    {

        try {
            $sql = "SELECT * FROM fashion_product e INNER JOIN base_product b ON e.id_base_product=b.id_base_product WHERE b.id_base_product = ?;";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $product ? new FashionEntity($product) : null;
    }

    public function create()
    {
        helper('form');

        $data = [
            'title' => 'Form Tambah Produk Fashion',
        ];

        return view('/fashion/add-product', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[base_product.name]',
            ],
            'type' => [
                'type' => 'required',
            ]
        ])) {
            return redirect()->to('/fashion/create')->withInput();
        }

        $name = $this->request->getVar('name');
        $type = $this->request->getVar('type');

        $imageFile = $this->request->getFile('image');

        if ($imageFile->getError() == 4) {
            $imageName = 'default.jpg';
        } else {
            $imageName = $imageFile->getRandomName();

            $imageFile->move('img', $imageName);
        }


        $this->db->autocommit(false);

        try {
            $stmt = $this->db->prepare("INSERT INTO base_product(name, image) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $imageName);
            $stmt->execute();
            $id_base_product = $stmt->insert_id;
            $stmt->close();

            $stmt = $this->db->prepare("INSERT INTO fashion_product(type, id_base_product) VALUES (?,?)");
            $stmt->bind_param("si", $type, $id_base_product);
            $stmt->execute();

            $stmt->close();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }

        return redirect()->to('/fashion');
    }

    public function edit($id)
    {
        helper('form');

        $product = $this->getProductById($id);

        $data = [
            'title' => 'Edit Elektronik Product',
            'product' => $product
        ];

        return view('/fashion/edit-product', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[base_product.name,id_base_product,' . $id . ']',
            ],
            'type' => [
                'type' => 'required',
            ]
        ])) {
            return redirect()->to('/fashion/edit/' . $id)->withInput();
        }

        $name = $this->request->getVar('name');
        $type = $this->request->getVar('type');
        $id_base_product = $this->request->getVar('idBaseProduct');
        $id_fashion_product = $this->request->getVar('idFashionProduct');

        $imageFile = $this->request->getFile('image');

        $oldImage = $this->request->getVar('oldImage');
        if ($imageFile->getError() == 4) {
            $imageName = $oldImage;
        } else {
            $imageName = $imageFile->getRandomName();

            $imageFile->move('img', $imageName);

            if ($oldImage != 'default.jpg') {
                //hapus gambar
                unlink('img/' . $oldImage);
            }
        }


        $this->db->autocommit(false);

        try {
            $stmt = $this->db->prepare("UPDATE base_product SET name=?, image=?  WHERE id_base_product = ?");
            $stmt->bind_param("ssi", $name, $imageName, $id_base_product);
            $stmt->execute();
            $stmt->close();

            $stmt = $this->db->prepare("UPDATE fashion_product SET type=?  WHERE id_fashion_product=?");
            $stmt->bind_param("si", $type, $id_fashion_product);
            $stmt->execute();
            $stmt->close();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }

        return redirect()->to('/fashion');
    }

    public function delete($id)
    {
        try {
            $product = $this->getProductById($id);
            if($product->getImage() != 'default.jpg'){
                unlink('img/' . $product->getImage());
            }

            $stmt = $this->db->prepare("DELETE FROM base_product WHERE id_base_product = ?;");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }
        return redirect()->to('/fashion');
    }



    public function product()
    {
        return view('/fashion/index');
    }
}
