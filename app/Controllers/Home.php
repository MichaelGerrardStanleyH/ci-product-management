<?php

namespace App\Controllers;

use App\Models\ElektronikModel;
use Attribute;

class Home extends BaseController
{

    protected $productElektronik;

    public function __construct()
    {
        $this->productElektronik = new ElektronikModel();
    }

    public function index()
    {
        $datas = $this->productElektronik->getAll(); // Now returns an array of UserEntity objects

        foreach($datas as $data){
            echo $data->getName();
            echo $data->getHarga();
            echo $data->getType();
            echo $data->getAliranListrik();
            echo ($data->getIsBaterai() == 1 ? "true" : "false");
        }
    }
}
