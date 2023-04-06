<?php

namespace App\Http\Controllers\BeverageType;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeverageType\BeverageTypeRequest;
use App\Http\Resources\Beverage\BeverageResource;
use App\Http\Resources\BeverageType\beverageTypeCollection;
use App\Http\Resources\BeverageType\beverageTypeResource;
use App\Models\BeverageType;
use Illuminate\Http\Request;

class BeverageTypeController extends Controller
{
    public function __construct(){

    }
    public function index()
    {
        $types = BeverageType::all();
        return response()->json([
            'status' => true,
            'result' => new beverageTypeCollection($types)
        ]);
    }

    public function store(BeverageTypeRequest $request)
    {
        $beverage_type = BeverageType::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'beverage type has been added Succeffully',
            'result' => new beverageTypeResource($beverage_type)
        ]);
    }

    
    public function show($id)
    {
        $type = BeverageType::where('id',$id)
        ->with('beverages')
        ->first();
        if($type){
            return response()->json([
                'status' => true,
                'result' => new beverageTypeResource($type)
            ]);
        }else{
            abort(404);
        }
    }
    public function update(BeverageTypeRequest $request, BeverageType $beverage_type)
    {
        $beverage_type->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'beverage type has been updated successfully',
            'result' => new beverageTypeResource($beverage_type)
        ]);
    }


    public function destroy(BeverageType $beverage_type)
    {
        $beverage_type->delete();
        return response()->json([
            'status' => true,
            'message' => 'beverage type has been deleted successfully',
        ]);
    }
}
