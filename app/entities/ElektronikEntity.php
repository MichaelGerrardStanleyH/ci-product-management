<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use PhpParser\Node\Expr\Cast\Bool_;

// child class ElektronikEntity
class ElektronikEntity extends BaseProductEntity
{
    private int $id_electronic_product;
    private int $electric;

    public function __construct(array $data = [])
    {
        if(!empty($data)){
            $this->id_electronic_product = (int) $data['id_electronic_product'] ?? 0;
            $this->electric = (int) $data['electric'] ?? 0;
    
            parent::__construct($data);
        }
    }

    public function getElectric(): int
    {
        return $this->electric;
    }

    public function setElectric(int $electric)
    {
        $this->electric=$electric;
    }


    public function getIdElectronicProduct(): int
    {
        return $this->id_electronic_product;
    }

    public function setIdElectronicProduct(int $id_electronic_product)
    {
        $this->id_electronic_product=$id_electronic_product;
    }
    
}
