<?php

namespace App\Repositories;

use Database\DB;

class ProductRepository
{
    /**
     * 取得所有產品
     * 
     * @return array|null
     */
    public function getAllProducts()
    {
        $statement = 'select * from `product`';
        return ($db = DB::getInstance()->query($statement)) === false ? null : $db->get();
    }
}
