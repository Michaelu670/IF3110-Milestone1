<?php

class StorageAccess
{
    private $storageDir;

    public const IMAGE_PATH = 'images';
    public const VIDEO_PATH = 'images';


    public function __construct($filename)
    {
        $this->storageDir = __DIR__ . '/../../storage/' . $filename . '/';
    }

    private function doesFileExist($filename)
    {
        return file_exists($this->storageDir . $filename);
    }

    public function getDir(){
        return ($this->storageDir);
    }

    public function saveImage($tempname)
    {
        $filesize = filesize($tempname);
        if($filesize > MAX_FILE_SIZE)
        {
            throw new LoggedException('Request Entity Too Large', 413);
        }

        $mimetype = mime_content_type($tempname);
        if(!in_array($mimetype, array_keys(ALLOWED_IMAGES)))
        {
            throw new LoggedException('Unsupported Media Type', 415);
        }

        $valid = false;
        while (!$valid)
        {
            $filename = md5(uniqid(mt_rand(), true)) . ALLOWED_IMAGES[$mimetype];
            $valid = !$this->doesFileExist($filename);

        }
        // print_r($this->storageDir . $filename);


        $success = move_uploaded_file($tempname, $this->storageDir . $filename);
        if (!$success)
        {
            throw new LoggedException('Internal Server Error', 500);
        }

        return $filename;
    }

    public function deleteFile($filename)
    {
        if (!$this->doesFileExist($filename)) {
            return;
        }

        $success = unlink($this->storageDir . $filename);
        if (!$success) {
            throw new LoggedException('Internal Server Error', 500);
        }
    }
}