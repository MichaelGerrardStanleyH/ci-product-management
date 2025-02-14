<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use PhpParser\Node\Expr\Cast\Bool_;

class ElektronikEntity extends ProductEntity
{
    private bool $is_baterai;
    private int $aliran_listrik;

    public function __construct(array $data = [])
    {
        if(!empty($data)){
            $this->is_baterai = (bool) $data['is_baterai'] ?? false;
            $this->aliran_listrik = (int) $data['aliran_listrik'] ?? 0;
    
            parent::__construct($data);
        }
    }

    // Getter for AliranListrik
    public function getAliranListrik(): string
    {
        return $this->aliran_listrik;
    }

    // Setter for AliranListrik
    public function setAliranListrik(string $aliran_listrik)
    {
        $this->aliran_listrik=$aliran_listrik;
    }

    // Getter for IsBaterai
    public function getIsBaterai(): string
    {
        return $this->is_baterai;
    }

    // Setter for IsBaterai
    public function setIsBaterai(string $is_baterai)
    {
        $this->is_baterai=$is_baterai;
    }
    
}
