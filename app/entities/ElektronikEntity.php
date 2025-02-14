<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ElektronikEntity extends ProductEntity
{
    protected $attributes = [
        'is_baterai' => null,
        'aliran_listrik' => null
    ];

    // // Getter for Name
    // public function getNama(): string
    // {
    //     return ucfirst($this->attributes['nama']); // Capitalize first letter
    // }

    // // Setter for Name
    // public function setNama(string $nama)
    // {
    //     $this->attributes['nama'] = strtolower($nama); // Store in lowercase
    //     return $this;
    // }

    // Getter for Name
    public function getHarga(): string
    {
        return ucfirst($this->attributes['harga']); // Capitalize first letter
    }

    // Setter for Name
    public function setHarga(string $nama)
    {
        $this->attributes['harga'] = strtolower($nama); // Store in lowercase
        return $this;
    }

    // Getter for Type
    public function getType(): string
    {
        return ucfirst($this->attributes['type']); // Capitalize first letter
    }

    // Setter for Type
    public function setType(string $nama)
    {
        $this->attributes['type'] = strtolower($nama); // Store in lowercase
        return $this;
    }

    // Getter for AliranListrik
    public function getAliranListrik(): string
    {
        return ucfirst($this->attributes['aliran_listrik']); // Capitalize first letter
    }

    // Setter for AliranListrik
    public function setAliranListrik(string $nama)
    {
        $this->attributes['aliran_listrik'] = strtolower($nama); // Store in lowercase
        return $this;
    }

    // Getter for IsBaterai
    public function getIsBaterai(): string
    {
        return ucfirst($this->attributes['is_baterai']); // Capitalize first letter
    }

    // Setter for IsBaterai
    public function setIsBaterai(string $nama)
    {
        $this->attributes['is_baterai'] = strtolower($nama); // Store in lowercase
        return $this;
    }
    

    // Custom method
    public function getFullDetails()
    {
        // return "Elektronik: {$this->attributes['nama']} ({$this->attributes['harga']})";
        return $this->attributes;
    }
}
