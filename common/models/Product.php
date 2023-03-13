<?php

namespace common\models;

use yii\db\ActiveRecord;
use Yii;
use common\components\behaviors\ExchangeRateBehavior;
use common\components\behaviors\HandleImageBehavior;
use common\components\behaviors\TranslationBehavior;
use yii\web\UploadedFile;


class Product extends ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => ExchangeRateBehavior::class,
                'priceAttribute' => 'price',
            ],
            [
                'class' => HandleImageBehavior::class,
                'imgAttribute' => 'img1',
                'baseUrl' => Yii::getAlias("@staticWeb"),
                'uploadPath' => Yii::getAlias("@static"),//'C:/xampp/htdocs/yii-application/static/',
            ],
            'translate'=> [
                'class'=> TranslationBehavior::class,
                'attributes'=> ['product_name','details'],
                'idCol'=>'idProd',
                'langTable'=> 'product_lang',
                'langTableFkColumn'=> 'product_id',
                'langTableLangColumn'=> 'language',
            ]
        ];
    }
    

    public function rules()
    {
        return [

            [['productName', 'price', 'description', 'category', 'created_by', 'date'], 'required'],
            [['productName', 'price', 'description', 'category', 'img1', 'img2', 'img3', 'created_by', 'date'], 'safe'],
            [['img1'], 'file', 'extensions' => 'png, jpg, jpeg, gif,webp'],
            [['created_by'], 'safe'],
            

        ];
    }
}
