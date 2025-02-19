<?php

namespace App\Controllers;

use App\Entities\ElektronikEntity;
use App\Models\ProductElektronikModel;
use App\Models\ElektronikModel;
use Exception;

// Class controller electronic
class Electronic extends BaseController
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

    // get all electronic product dari database yang return class view index.php
    public function index()
    {
        try {
            $sql = "SELECT * FROM electronic_product e INNER JOIN base_product b ON e.id_base_product=b.id_base_product;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new ElektronikEntity($row);
            $products[] = $product;
        }

        $data = [
            'title' => 'Electronic Product',
            'products' => $products
        ];
        return view('electronic/index', $data);
    }


    // get electronic product by id dari database yang return class ElektronikEntity
    public function getProductById($id)
    {

        try {
            $sql = "SELECT * FROM electronic_product e INNER JOIN base_product b ON e.id_base_product=b.id_base_product WHERE b.id_base_product = ?;";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $product ? new ElektronikEntity($product) : null;
    }

    // return class view create.php 
    public function create()
    {
        helper('form');

        $data = [
            'title' => 'Add Electronic Product Form',
        ];

        return view('electronic/add-product', $data);
    }

    // insert produk elektronik ke database dan return kew view index.php
    public function save()
    {

        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[base_product.name]',
            ],
            'electric' => [
                'electric' => 'required',
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            ]
        ])) {
            return redirect()->to('/electronic/create')->withInput();
        }

        $name = $this->request->getVar('name');
        $electric = $this->request->getVar('electric');

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

            $stmt = $this->db->prepare("INSERT INTO electronic_product(electric, id_base_product) VALUES (?,?)");
            $stmt->bind_param("ii", $electric, $id_base_product);
            $stmt->execute();

            $stmt->close();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }

        return redirect()->to('/electronic');
    }

    //return class view edit-product.php
    public function edit($id)
    {
        helper('form');

        $product = $this->getProductById($id);

        $data = [
            'title' => 'Edit Electronic Product Form',
            'product' => $product
        ];

        return view('/electronic/edit-product', $data);
    }

    //update elektronik produk ke database dan return class view index.php
    public function update($id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required|is_unique[base_product.name,id_base_product,' . $id . ']',
            ],
            'electric' => [
                'electric' => 'required',
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
            ]
        ])) {
            return redirect()->to('/electronic/edit/' . $id)->withInput();
        }

        $name = $this->request->getVar('name');
        $electric = $this->request->getVar('electric');
        $id_base_product = $this->request->getVar('idBaseProduct');
        $id_electronic_product = $this->request->getVar('idElectronicProduct');

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

            $stmt = $this->db->prepare("UPDATE electronic_product SET electric=?  WHERE id_electronic_product=?");
            $stmt->bind_param("ii", $electric, $id_electronic_product);
            $stmt->execute();
            $stmt->close();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            throw new Exception($e->getMessage());
        }

        return redirect()->to('/electronic');
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
        return redirect()->to('/electronic');
    }
}
