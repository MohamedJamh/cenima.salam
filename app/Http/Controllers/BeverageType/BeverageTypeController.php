<?php

namespace App\Http\Controllers\BeverageType;

use App\Http\Controllers\Controller;
use App\Http\Resources\Beverage\BeverageResource;
use App\Http\Resources\BeverageType\beverageTypeCollection;
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

    public function store(Request $request)
    {
        
    }

    
    public function show($id)
    {
        $type = BeverageType::find($id);
        if($type){
            return response()->json([
                'status' => true,
                'result' => new beverageTypeCollection(BeverageType::find($id)->with('beverages')->get())
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
