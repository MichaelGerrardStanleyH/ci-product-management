<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ProductEntity extends Entity
{
    protected $attributes = [
        'id' => null,
        'nama' => null,
        'harga' => null,
        'type' =>  null
    ];

    // Getter for Name
    public function getId(): string
    {
        return ucfirst($this->attributes['id']); // Capitalize first letter
    }

    // Setter for Name
    public function setId(string $id)
    {
        $this->attributes['id'] = strtolower($id); // Store in lowercase
        return $this;
    }

    // Getter for Name
    public function getNama(): string
    {
        return ucfirst($this->attributes['nama']); // Capitalize first letter
    }

    // Setter for Name
    public function setNama(string $nama)
    {
        $this->attributes['nama'] = strtolower($nama); // Store in lowercase
        return $this;
    }

    // // Custom method
    // public function getFullDetails(): string
    // {
    //     return "Elektronik: {$this->attributes['nama']} ({$this->attributes['harga']})";
    // }
}
