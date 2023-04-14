<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store($imageData , $type , $path){
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $filename = $type . time() . '.jpg';
        $imageDirectory = storage_path('app/public/images/'. $path . $filename);
        file_put_contents($imageDirectory, $image);
        
        return 'http://cenima.salam.test/storage/images/'. $path . $filename ;
    }

    public function destory($imageUrl){
        Storage::disk('public')->delete($imageUrl);
    }
}
