<?php

namespace App\Http\Traits;

use JetBrains\PhpStorm\ArrayShape;

class MediaTrait
{
    /**
     * @param $name
     * @param $tmp_name
     * @param $size
     * @param string $target_dir
     * @return array
     */
    #[ArrayShape(['uploadOk' => "int", 'messages' => "array"])]
    public function uploadImage($name, $tmp_name, $size, string $target_dir) : array
    {
        $target_file = $target_dir . basename($name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $messages = [];

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($tmp_name);
            if($check !== false){
                $uploadOk = 1;
            } else {
                array_push($messages, "File is not an image.");
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            array_push($messages, "Sorry, file already exists.");
            $uploadOk = 0;
        }

        // Check file size
        if ($size > 500000) {
            array_push($messages, "Sorry, your file is too large.");
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            array_push($messages, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            array_push($messages, "Sorry, your file was not uploaded.");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($tmp_name, $target_file)) {
                array_push($messages, "The file " . htmlspecialchars(basename($name)) . " has been uploaded.");
            } else {
                array_push($messages, "Sorry, there was an error uploading your file.");
            }
        }
        return ['uploadOk' => $uploadOk, 'messages' => $messages];
    }

}