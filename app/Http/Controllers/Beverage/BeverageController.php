<?php

namespace App\Http\Controllers\Beverage;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Image\ImageController;
use App\Http\Requests\Beverage\BeverageRequest;
use App\Http\Requests\Beverage\BeverageUpdateRequest;
use App\Http\Resources\Beverage\BeverageCollection;
use App\Http\Resources\Beverage\BeverageResource;
use App\Models\Beverage;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeverageController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api']);
        $this->middleware(['role:admin'])->except(['index']);
    }
    public function index()
    {
        $beverage = Beverage::with(['beverageType','image'])->get();
        return response()->json([
            'status' => true,
            'result' => new BeverageCollection($beverage)
        ]);
    }
    public function store(BeverageRequest $request)
    {
        $beverage = Beverage::create($request->only([
            'title',
            'description',
            'price',
            'beverage_type_id'
        ]));

        $beverage->image()->create([
            'type' => 'poster',
            'url' => (new ImageController)->store($request->input('image'),'poster','beverages/')
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Beverage item added succeffully',
            'result' => new BeverageResource($beverage)
        ]);
    }
    public function update(BeverageUpdateRequest $request, Beverage $beverage)
    {
        $beverage->update($request->only([
            'title',
            'description',
            'price',
            'beverage_type_id'
        ]));
        
        if($request->has('image')){
            $oldPoster = $beverage->image;
            (new ImageController)->destory(substr($oldPoster->url,32));
            $oldPoster->delete();
            
            $beverage->image()->create([
                'type' => 'poster',
                'url' => (new ImageController)->store($request->input('image'),'poster','beverages/')
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Beverage item updated succeffully',
            'result' => new BeverageResource($beverage)
        ]);

    }
    public function destroy(Beverage $beverage)
    {
        $oldPoster = $beverage->image;
        (new ImageController)->destory(substr($oldPoster->url,32));
        $oldPoster->delete();
        $beverage->delete();
        return response()->json([
            'status' => true,
            'message' => 'Beverage item deleted succeffully'
        ]);

    }
}
