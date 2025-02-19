<?php

namespace App\Controllers;

use App\Entities\ElektronikEntity;
use App\Entities\FashionEntity;
use App\Models\ProductElektronikModel;
use App\Models\ElektronikModel;
use Exception;

// Class controller fashion
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

    // get all fashion product dari database yang return class view index.php
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


    // get fashion product by id dari database yang return class ElektronikEntity
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

    // return class view create.php 
    public function create()
    {
        helper('form');

        $data = [
            'title' => 'Add Fashion Product Form',
        ];

        return view('/fashion/add-product', $data);
    }

    // insert produk elektronik ke database dan return kew view index.php
    public function save()
    {

        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[base_product.name]',
            ],
            'type' => [
                'type' => 'required',
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
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

    //return class view edit-product.php
    public function edit($id)
    {
        helper('form');

        $product = $this->getProductById($id);

        $data = [
            'title' => 'Edit Fashion Product Form',
            'product' => $product
        ];

        return view('/fashion/edit-product', $data);
    }

    //update elektronik produk ke database dan return class view index.php
    public function update($id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[base_product.name,id_base_product,' . $id . ']',
            ],
            'type' => [
                'type' => 'required',
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
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

    //delete produk elektronik by id dari database
    public function delete($id)
    {
        try {
            $product = $this->getProductById($id);
            if ($product->getImage() != 'default.jpg') {
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
}
