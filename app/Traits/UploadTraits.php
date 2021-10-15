<?php


namespace App\Traits;


use Illuminate\Http\Request;

trait UploadTraits
{
    private function imageUpload($images, $imageColumn = null){

        $uploadImages = [];

        if(!is_null($imageColumn)) {
            foreach ($images as $image) {
                $uploadImages[] = [$imageColumn => $image->store('posts', 'public')];
            }
        } else{
            $uploadImages = $images->store('posts', 'public');
        }
        return $uploadImages;
    }
}
