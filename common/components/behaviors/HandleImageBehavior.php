<?php

namespace common\components\behaviors;

use yii\base\Behavior;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

class HandleImageBehavior extends Behavior
{
    public $imgAttribute;
    public $uploadPath;
    public $baseUrl;
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'uploadImage',
            ActiveRecord::EVENT_AFTER_UPDATE => 'uploadImage',
        ];
    }
    public function uploadImage()
    {
        $image = UploadedFile::getInstance($this->owner, $this->imgAttribute);
        $this->upload($image);
    }
    public function __get($name)
    {
        if ($name == 'image_path') {
            // print_r($this->owner->{$this->uploadPath});
            return $this->uploadPath . DIRECTORY_SEPARATOR . $this->owner->{$this->imgAttribute};
            
        } else if ($name == 'image_url') {
            return $this->baseUrl . DIRECTORY_SEPARATOR . $this->owner->{$this->imgAttribute};
        }
        return false;
    }
    public function canGetProperty($name, $checkVars = true)
    {
        if ($name == 'image_path' || $name == 'image_url') {
            return true;
        }
        return false;
    }
    

    public function upload($image)
    {
        if ($image != NULL) {
            //check if folder exists, if not create it
            $image->saveAs($this->uploadPath. DIRECTORY_SEPARATOR . $image->baseName . '.' . $image->extension);
            return true;
        } else {
            echo "<pre>";
            print_r($this->errors);
            echo "</pre>";
            return false;
        }
    }
}
