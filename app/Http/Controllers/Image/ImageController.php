<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function store($imageData){
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $filename = time() . '.jpg';
        $path = storage_path('app/public/images/beverages/' . $filename);
        file_put_contents($path, $image);
        
        return $path;
    }
}
