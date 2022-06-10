<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ModelsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCompany(Request $request)
    {
        $models = DB::table('models')
            ->where('company_id', $request->post('company_id'))
            ->get();

        return response()->json(['models' => $models], 200);
    }
}
