<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use PhpParser\Node\Expr\Cast\Bool_;

// child class FashionEntity
class FashionEntity extends BaseProductEntity
{
    private int $id_fashion_product;
    private string $type;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->id_fashion_product = (int) $data['id_fashion_product'] ?? 0;
            $this->type = (string) $data['type'] ?? '';

            parent::__construct($data);
        }
    }


    public function getType(): string
    {
        return $this->type;
    }
#
    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getIdFashionProduct(): int
    {
        return $this->id_fashion_product;
    }

    public function setIdFashionProduct(int $id_fashion_product)
    {
        $this->id_fashion_product = $id_fashion_product;
    }
}
