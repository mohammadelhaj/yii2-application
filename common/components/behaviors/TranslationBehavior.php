<?php

namespace common\components\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use common\models\Category_lang;
use ReflectionClass;
use yii\base\UnknownPropertyException;
use yii\db\Query;

class TranslationBehavior extends Behavior
{

    public $idCol;
    public $langTable;
    public $langTableFkColumn;
    public $langTableLangColumn;
    public $attributes = [];

    public $languages = ['fr', 'en'];
    public $translationAttrs = [];

    public function init()
    {
        foreach ($this->languages as $lang) {
            foreach ($this->attributes as $attr) {
                $this->translationAttrs[] = "{$attr}_{$lang}";
            }
        }
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'translatedWord',
            ActiveRecord::EVENT_AFTER_INSERT => 'saveTranslation',
            ActiveRecord::EVENT_AFTER_UPDATE => 'saveTranslation',

        ];
    }
    public function saveTranslation()
    {
        
        $queryAttrs = "";
        foreach ($this->attributes as $attr) {
            $queryAttrs .= ", `{$attr}`";
        }

       
        foreach ($this->languages as $lang) {    
            $query = "INSERT INTO {$this->langTable}  (`{$this->langTableFkColumn}`,`{$this->langTableLangColumn}` {$queryAttrs})";
            $queryValues = "";    
            $dupValues = [];
            foreach ($this->attributes as $attr) {
                $post = Yii::$app->request->post((new ReflectionClass($this->owner::class))->getShortName());
                if (empty($post["{$attr}_{$lang}"])) {
                    $post["{$attr}_{$lang}"] = "";
                }
                $val = $post["{$attr}_{$lang}"];  
                $queryValues .= ", '{$val}'";
                $dupValues[] = "`{$attr}` = '$val'";
            }
            $query .= "VALUES (" . $this->owner->{$this->idCol} . ",'$lang' {$queryValues})  ON DUPLICATE KEY UPDATE " . implode(", ", $dupValues);
            
        $data = Yii::$app->db->createCommand($query)->queryAll();
        }
        return;

        // foreach ($this->languages as $lang) {
        //     $query = "";
        //     foreach ($this->attributes as $attr) {
        //         $post = Yii::$app->request->post((new ReflectionClass($this->owner::class))->getShortName());
        //         // echo "<pre>";
        //         // print_r($post);
        //         // echo "</pre>";
        //         // exit();
        //         if (empty($post["{$attr}_{$lang}"])) {
        //             continue;
        //         }

        //         $val = $post["{$attr}_{$lang}"];

        //         $query = "INSERT 
        //         INTO $this->langTable (`{$this->langTableFkColumn}`,`{$this->langTableLangColumn}`,`{$attr}`)
        //         VALUES (" . $this->owner->{$this->idCol} . ",'$lang', '$val')
        //         ON DUPLICATE KEY UPDATE `{$attr}` = '$val';";
        //         $data = Yii::$app->db->createCommand($query)->queryAll();
        //         // $query = "INSERT 
        //         // INTO $this->langTable 
        //         // (`{$this->langTableFkColumn}`,`{$this->langTableLangColumn}`,`{$attr}`)
        //         // VALUES (" . $this->owner->{$this->idCol} . ",'$lang', '$val') ";
        //         // $data = Yii::$app->db->createCommand($query)->queryAll();

        //     }
        // }
    }
  


    public function translatedWord()
    {

        $language = Yii::$app->request->cookies->getValue('language');

        if ($language != null) {
            Yii::$app->language = $language;
        } else {
            $language = Yii::$app->request->cookies->getValue('language', 'en');
        }
    }

    public function __get($name)
    {
        try {
            return parent::__get($name);
        } catch (UnknownPropertyException $e) {
            if (in_array($name, $this->attributes)) {
                $translation = (new Query())
                    ->select([$name])
                    ->from($this->langTable)
                    ->where([
                        'AND',
                        [$this->langTableFkColumn => $this->owner->{$this->idCol}],
                        [$this->langTableLangColumn => Yii::$app->language]
                    ])
                    ->one();
                if (!empty($translation)) {
                    return $translation[$name];
                }
                return "";
            }

            if (in_array($name, $this->translationAttrs)) {
                $nameWithoutLanguage = substr($name, 0, -3);
                $attrLang = substr($name, -2);
                $translation = (new Query())
                    ->select([$nameWithoutLanguage])
                    ->from($this->langTable)
                    ->where([
                        'AND',
                        [$this->langTableFkColumn => $this->owner->{$this->idCol}],
                        [$this->langTableLangColumn => $attrLang]
                    ])
                    ->one();
                if (!empty($translation)) {
                    return $translation[$nameWithoutLanguage];
                }
                return "";
            }
            throw $e;
        }
    }

    public function canGetProperty($name, $checkVars = true)
    {
        if (in_array($name, $this->attributes)) {
            return true;
        }

        if (in_array($name, $this->translationAttrs)) {
            return true;
        }
        return false;
    }

    public function canSetProperty($name, $checkVars = true)
    {
        if (in_array($name, $this->attributes)) {
            return true;
        }
        if (in_array($name, $this->translationAttrs)) {
            return true;
        }
        return false;
    }
}
