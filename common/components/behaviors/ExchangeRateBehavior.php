<?php

namespace common\components\behaviors;

use yii\base\Behavior;

class ExchangeRateBehavior extends Behavior
{

    public $priceAttribute = 'price';

    public function __get($name)
    {
        if ($name == 'price_lbp') {
            return $this->owner->{$this->priceAttribute} * 60000;
        }

        return parent::__get($name);
    }

    public function canGetProperty($name, $checkVars = true)
    {
        if ($name == 'price_lbp') {
            return true;
        }

        return false;
    }
}
