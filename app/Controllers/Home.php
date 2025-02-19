<?php

namespace App\Controllers;

use App\Models\ElektronikModel;
use Attribute;

class Home extends BaseController
{

    public function index()
    {
        $data = [
            'title' => 'Home | Product Management'
        ];

       return view('/home', $data);
    }

}
