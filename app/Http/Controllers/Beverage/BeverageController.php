<?php

namespace App\Http\Controllers\Beverage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Beverage\BeverageRequest;
use App\Http\Resources\Beverage\BeverageCollection;
use App\Http\Resources\Beverage\BeverageResource;
use App\Models\Beverage;
use Illuminate\Http\Request;

class BeverageController extends Controller
{
    public function __construct(){
        // auth , verified and admin Middleware
    }
    public function index()
    {
        $beverage = Beverage::with(['beverageType'])->get();
        return response()->json([
            'status' => true,
            'result' => new BeverageCollection($beverage)
        ]);
    }
    public function store(BeverageRequest $request)
    {
        $beverage = Beverage::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Beverage item added succeffully',
            'result' => new BeverageResource($beverage)
        ]);
    }
    public function update(BeverageRequest $request, Beverage $beverage)
    {
        $beverage->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Beverage item updated succeffully',
            'result' => new BeverageResource($beverage)
        ]);

    }
    public function destroy(Beverage $beverage)
    {
        $beverage->delete();
        return response()->json([
            'status' => true,
            'message' => 'Beverage item deleted succeffully'
        ]);

    }
}
