<?php

namespace App\Controllers;

use App\Entities\ElektronikEntity;
use App\Models\ProductElektronikModel;
use App\Models\ElektronikModel;
use Exception;

class Elektronik extends BaseController
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
        $sql = "SELECT * FROM electronic_product e INNER JOIN base_product b ON e.id_base_product=b.id_base_product;";
        $stmt = $this->db->prepare($sql);
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
    public function getProductById($id)
    {
        $sql = "SELECT * FROM electronic_product e INNER JOIN base_product b ON e.id_base_product=b.id_base_product WHERE b.id_base_product = ?;";
        $stmt = $this->db->prepare($sql);
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

        return redirect()->to('/elektronik');
    }

    public function edit($id)
    {

        $product = $this->getProductById($id);

        $data = [
            'title' => 'Edit Elektronik Product',
            'product' => $product
        ];

        return view('/elektronik/edit-product', $data);
    }

    public function update()
    {
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

        return redirect()->to('/elektronik');
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM base_product WHERE id_base_product = ?;");
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
