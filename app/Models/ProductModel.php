<?php 

namespace App\Models;

use App\Entities\ElektronikEntity;
use CodeIgniter\Model;


class ProductModel extends Model{

    private function getAll()
    {
        $data = $this->findAll(); // Store the result in the class
        return $data; // Return the model instance instead of the array
    }

    

}

?>