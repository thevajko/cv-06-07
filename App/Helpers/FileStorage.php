<?php

namespace App\Helpers;

class FileStorage
{
    /**
     * Uploads file to given directory
     * @param $fileData
     * @param $dirToSave
     * @return string|null String containing relative file path or null in case of error
     */
    public static function uploadFile($fileData, $dirToSave) {
        // generating prefix
        $filePrefix = microtime();
        // build storing file path
        $filePath = $dirToSave. "/" . $filePrefix . "-" .$fileData['name'];
        // do the move
        if (move_uploaded_file($fileData['tmp_name'], $filePath)) {
            return $filePath;
        }
        return null;
    }

    public static function deleteFile(mixed $getText)
    {
        unlink($getText);
    }
}