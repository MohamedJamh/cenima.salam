<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Companie\ProductionCompanyCollection;
use App\Models\ProductionCompany;
use Illuminate\Http\Request;

class ProductionCompaniesController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:api','role:admin']);
    }
    public function index(){
        $companies = ProductionCompany::all();
        return response()->json([
            'status' => true,
            'result' => new ProductionCompanyCollection($companies)
        ]);
    }
}
