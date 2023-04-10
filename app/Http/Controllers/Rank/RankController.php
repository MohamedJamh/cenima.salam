<?php

namespace App\Http\Controllers\Rank;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rank\RankCollection;
use App\Models\Rank;
use Illuminate\Http\Request;

class RankController extends Controller
{
    public function index(){
        $ranks = Rank::all();
        return response()->json([
            'status' => true,
            'result' => new RankCollection($ranks)
        ]);
    }
}
