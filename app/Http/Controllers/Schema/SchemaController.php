<?php

namespace App\Http\Controllers\Schema;

use App\Http\Controllers\Controller;
use App\Http\Resources\Schema\SchemaCollection;
use App\Http\Resources\Schema\SchemaResource;
use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api','role:admin']);
    }
    public function index(){
        $schemas = Schema::all();
        return response()->json([
            'status' => true,
            'result' => new SchemaCollection($schemas)
        ]);
    }

    public function show(Schema $schema){
        $theater = $schema::with('theaters')->find($schema->id);
        return response()->json([
            'status' => true,
            'result' => new SchemaResource($theater)
        ]);
    }
}
