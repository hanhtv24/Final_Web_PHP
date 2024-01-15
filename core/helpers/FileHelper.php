<?php

namespace app\core\helpers;

class FileHelper
{
    public static function uploadFile($model, $attribute, $uploadDir, $request)
    {
        $file = $request->getFile($attribute);
        
        if ($file && $file['error'] === UPLOAD_ERR_OK) {
            if (self::isImageFile($file['tmp_name'])) {
                $originalFilename = $file['name'];
                $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);

                $filename = uniqid() . '.' . $extension;
                $filePath = $uploadDir . '/' . $filename;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                move_uploaded_file($file['tmp_name'], $filePath);

                $model->{$attribute} = $uploadDir . '/' . $filename;
            } else {
                $model->addError($attribute, 'The uploaded file is not recognized as an image');
            }
        }
    }

    static function isImageFile($filePath)
    {
        if (!file_exists($filePath)) {
            return false;
        }
        $imageInfo = @getimagesize($filePath);

        return $imageInfo !== false && in_array($imageInfo[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP], true);
    }

    public static function removeFile($filePath)
    {
        if (is_file($filePath) && file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
