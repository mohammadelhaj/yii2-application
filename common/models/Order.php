<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\rbac\Item;

class Order extends ActiveRecord
{


    public function rules()
    {
        return [

            [['first_name', 'last_name', 'address'], 'required'],
            [['user_id', 'total_cost', 'order_status', 'date'], 'safe'],

        ];
    }

    public function getItems(){
        return $this->hasMany(Items::class, ['order_id'=>'id']);
    }

    public function extraFields()
    {
        return [
            'items'
        ];
    }
}
