<?php

namespace App\Models;

use App\Entities\ElektronikEntity;
use App\Models\ProductModel;

class ElektronikModel extends ProductModel{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'harga', 'type', 'is_baterai', 'aliran_listrik'];
    protected $returnType = ElektronikEntity::class;


    public function getAllElectronicProduct()
    {
        $data = $this->where(['type' => 'elektronik'])->findAll(); // Store the result in the class
        return $data; // Return the model instance instead of the array
    }

    public function getElectronicProductById($id){
        $data = $this->where(['id' => $id, 'type' => 'elektronik'])->first();
        return $data;
    }
    
    public function deleteById($id){
        $this->delete(['id' => $id, 'type' => 'elektronik']);
    }

}

?>