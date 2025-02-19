<?php

namespace App\Controllers;

use App\Models\ElektronikModel;
use Attribute;

//Class controller home
class Home extends BaseController
{

    //return class home page
    public function index()
    {
        $data = [
            'title' => 'Home | Product Management'
        ];

       return view('/home', $data);
    }

}
