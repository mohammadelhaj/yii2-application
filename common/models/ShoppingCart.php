<?php

namespace common\models;

use yii\db\ActiveRecord;

class ShoppingCart extends ActiveRecord
{
    public static function tableName()
    {
        return 'shopping-cart';
    }
 
    public function getProduct(){
        return $this->hasOne(Product::class, ['idProd'=>'product_id']);
    }

}
