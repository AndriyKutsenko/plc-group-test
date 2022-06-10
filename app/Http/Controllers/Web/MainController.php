<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $vehicles = DB::table('vehicles')
            ->select('vehicles.*', 'companies.name as company_name', 'models.name as model_name', 'fuel_types.name as fuel_type_name', 'countries.name as country_name')
            ->orderBy('id', 'desc')
            ->join('companies', 'vehicles.company_id', '=', 'companies.id')
            ->join('models', 'vehicles.model_id', '=', 'models.id')
            ->join('fuel_types', 'vehicles.fuel_type_id', '=', 'fuel_types.id')
            ->join('countries', 'vehicles.country_id', '=', 'countries.id')
            ->get();

        return view('web.index', ['vehicles' => $vehicles]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $vehicle = DB::table('vehicles')
            ->select('vehicles.*', 'companies.name as company_name', 'models.name as model_name', 'fuel_types.name as fuel_type_name', 'countries.name as country_name')
            ->where('vehicles.id', $request->id)
            ->orderBy('id', 'desc')
            ->join('companies', 'vehicles.company_id', '=', 'companies.id')
            ->join('models', 'vehicles.model_id', '=', 'models.id')
            ->join('fuel_types', 'vehicles.fuel_type_id', '=', 'fuel_types.id')
            ->join('countries', 'vehicles.country_id', '=', 'countries.id')
            ->first();

        return view('web.detail', ['vehicle' => $vehicle]);
    }

    /**
     * P – цена авто, R – заявленная стоимость авто, D – стоимость доставки, F – ввозная
     *  пошлина, E – акциз, F – тип топлива, L – коэффициент топлива, V – объем двигателя в см3
     *  ,
     *  Y – год выпуска авто, K – коэффициент возраста авто, X – курc валют пары USD: EUR, T -
     *  НДС
     *  R = P + D
     *  K = текущий год – Y – 1, если K > 15 то K = 15
     *  L =
     *  - F = Дизель и V > 3500 то 150
     *  - F = Дизель и V <= 3500 то 75
     *  - F = Бензин и V > 3000 то 100
     *  - F = Бензин и V <= 3000 то 50
     *  E = L * K * V / 1000 * X
     *  F = R * 10%
     *  T = (E + F + R) * 20%
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delivery(Request $request)
    {
        $vehicle = DB::table('vehicles')
            ->where('id', $request->post('vehicle_id'))
            ->first();

        $deliveryCost = DB::table('delivery_costs')
            ->where('country_id', $vehicle->country_id)
            ->first();

        $varR = $vehicle->cost + $deliveryCost->cost;

        $varK = (int)date('Y') - (int)$vehicle->year;
        $varK = $varK > 15 ? 15 : $varK;

        // Здесь должна быть более правильная обработка типа топлива, например через константы, прописанные в модели, но пока упростим
        $varL = 1;
        if ($vehicle->fuel_type_id == 1 and $vehicle->engine_volume > 3000) {
            $varL = 100;
        } elseif ($vehicle->fuel_type_id == 1 and $vehicle->engine_volume <= 3000) {
            $varL = 50;
        } elseif ($vehicle->fuel_type_id == 2 and $vehicle->engine_volume > 3500) {
            $varL = 150;
        } elseif ($vehicle->fuel_type_id == 2 and $vehicle->engine_volume <= 3500) {
            $varL = 75;
        }

        $varX = 1.2;
        $varE = $varL * $varK * $vehicle->engine_volume / 1000 * $varX;
        $varF = $varR * 0.1;
        $varT = ($varE + $varF + $varR) * 0.2;

        return response()->json([
            'varE' => $varE,
            'varF' => $varF,
            'varT' => $varT,
        ], 200);
    }
}
