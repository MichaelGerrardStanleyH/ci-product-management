<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

// Parent class base product
class BaseProductEntity
{

    private int $id_base_product;
    private string $name;
    private string $image;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->id_base_product = (int) $data['id_base_product'] ?? 0;
            $this->name = (string) $data['name'] ?? '';
            $this->image = (string) $data['image'] ?? '';
        }
    }


    public function getIdBaseProduct(): int
    {
        return $this->id_base_product;
    }


    public function setId(string $id_base_product)
    {
        $this->id_base_product = $id_base_product;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getImage(): string
    {
        return $this->image;
    }


    public function setImage(string $image)
    {
        $this->image = $image;
    }
}
