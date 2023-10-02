<?php

namespace App\Helpers;

class FileStorage
{
    public static function checkIfIsFileImage($fileName){
        // we need only extensions, which is located after a dot
        $exploded = explode(".", trim($fileName));
        // file name can have multiple dots in it, bud extension is at the last possition
        $fileExtension = strtolower($exploded[count($exploded) - 1]);
        // check if is extension match one of the valid formats
        return in_array($fileExtension, [ "jpg", "jpeg", "png", "gif", "webp"]);
    }

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