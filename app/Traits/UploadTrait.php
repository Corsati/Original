<?php

namespace App\Traits;
use Request;
use Image;

trait UploadTrait
{



    public function uploadImg( $file , $directory = 'unknown' ){
        if( Request::wantsJson() ) {
            return  $this->uploadBase64($file, $directory);
        }else{
            return  $this->uploadFile($file, $directory);
        }
    }

    public function uploadFile($file, $directory = 'unknown'): string
    {
        $name = time() . rand(1000000, 9999999) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('/storage/images/' . $directory, $name);
        return $name;
    }

    public function uploadVideo($file, $directory = 'unknown'): string
    {
        $name = time() . rand(1000000, 9999999) . '.' . $file->getClientOriginalExtension();
        $file->move(base_path().'/storage/app/public/videos/' . $directory, $name);
        return $name;
    }

    public static function uploadBase64($base64, $path) : string
    {
        $imgName   = uniqid() . '-' . time() . '-' . rand(1111,9999) . '.jpg';
        file_put_contents(base_path().'/storage/app/public/images/' . $path . '/' . $imgName, base64_decode($base64));
        return (string) $imgName;
    }

    public function deleteFile($file_name, $directory = 'unknown'): void
    {
        if ($file_name && file_exists('public/storage/images/' . $directory . '/' . $file_name)) {
            unlink('public/storage/images/' . $directory . '/' . $file_name);
        }
    }

}
