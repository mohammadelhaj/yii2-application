<?php

namespace common\models;

use common\components\behaviors\TranslationBehavior;
use yii\db\ActiveRecord;


class Category extends ActiveRecord 
{
    

    public function rules()
    {
        return [

            [['categoryName'], 'required'],          
            [['date'], 'safe'],
            ['categoryName','unique'],
            [['created_by'],'safe']

        ];
    }
    
    public function behaviors()
    {
        return [
            // 'translate'=> [
            //     'class'=> TranslationBehavior::class,
            //     'attributes'=> ['category_name'],
            //     'idCol'=>'idCat',
            //     'langTable'=> 'category_lang',
            //     'langTableFkColumn'=> 'category_id',
            //     'langTableLangColumn'=> 'language',
            // ]
        ];
    }
    
    public function fields(){
        return [
            'idCat',
            'id'=> function($model){
                return $model->idCat;
            }
        ];
    }
}
