<?php

namespace app\core\helpers;

class UploadHelper
{
    public static function uploadFile($model, $attribute, $uploadDir, $request)
    {
        $file = $request->getFile($attribute);
        
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            $filename = $file['name'];
            
            $filePath = $uploadDir . '/' . $filename;
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            
            move_uploaded_file($file['tmp_name'], $filePath);
            
            $model->{$attribute} = $uploadDir . '/' . $filename;
        }
    }
}
