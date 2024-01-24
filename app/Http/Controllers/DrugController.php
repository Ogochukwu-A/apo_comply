<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Drugs;

class DrugController extends Controller
{
    // search for drugs 
    public function search(Request $request)
    {
        $query = $request->input('q');

        $drugs = Drugs::where('name', 'like', "%$query%")->get();

        return response()->json($drugs);
    }
}

