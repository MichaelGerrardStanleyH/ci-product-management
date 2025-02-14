<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class ProductEntity
{

    private int $id;
    private string $nama;
    private int $harga;
    private string $type;

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->id = (int) $data['id'] ?? 0;
            $this->nama = (string) $data['nama'] ?? '';
            $this->harga = (int) $data['harga'] ?? 0;
            $this->type = (string) $data['type'] ?? '';
        }
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getNama(): string
    {
        return $this->nama;
    }


    public function setNama(string $nama)
    {
        $this->nama = $nama;
    }

    public function getHarga(): string
    {
        return $this->harga;
    }


    public function setHarga(string $harga)
    {
        $this->nama = $harga;
    }

    public function getType(): string
    {
        return $this->type;
    }


    public function setType(string $type)
    {
        $this->nama = $type;
    }
}
