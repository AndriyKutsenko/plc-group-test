<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VehiclesController extends Controller
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

        return view('admin.vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $companies = DB::table('companies')->get();
        $models = DB::table('models')->where('company_id', 1)->get();
        $fuelTypes = DB::table('fuel_types')->get();
        $countries = DB::table('countries')->get();

        return view('admin.vehicles.add', [
            'companies' => $companies,
            'models' => $models,
            'fuelTypes' => $fuelTypes,
            'countries' => $countries,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        // Валидация для примера, год обязателен
//        $request->validate([
//            'year' => 'required',
//        ]);

        $data = $request->post();

        DB::table('vehicles')->insert([
            'company_id' => $data['company'],
            'model_id' => $data['model'],
            'vin' => (null !== $data['vin'] ? $data['vin'] : ''),
            'fuel_type_id' => $data['fuel'],
            'engine_volume' => (null !== $data['engine'] ? $data['engine'] : 0),
            'year' => (null !== $data['year'] ? $data['year'] : date('Y')),
            'cost' => str_replace(',', '.', null !== $data['cost'] ? $data['cost'] : 0),
            'country_id' => $data['country'],
        ]);

        return redirect(route('vehicles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $vehicle = DB::table('vehicles')->where('id', $request->id)->first();

        $companies = DB::table('companies')->get();
        $models = DB::table('models')->where('company_id', $vehicle->company_id)->get();
        $fuelTypes = DB::table('fuel_types')->get();
        $countries = DB::table('countries')->get();

        return view('admin.vehicles.edit', [
            'vehicle' => $vehicle,
            'companies' => $companies,
            'models' => $models,
            'fuelTypes' => $fuelTypes,
            'countries' => $countries,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $data = $request->post();

        DB::table('vehicles')
            ->where('id', $request->id)
            ->update([
            'company_id' => $data['company'],
            'model_id' => $data['model'],
            'vin' => (null !== $data['vin'] ? $data['vin'] : ''),
            'fuel_type_id' => $data['fuel'],
            'engine_volume' => (null !== $data['engine'] ? $data['engine'] : 0),
            'year' => (null !== $data['year'] ? $data['year'] : date('Y')),
            'cost' => str_replace(',', '.', null !== $data['cost'] ? $data['cost'] : 0),
            'country_id' => $data['country'],
        ]);

        return redirect(route('vehicles'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        DB::table('vehicles')->where('id', $request->id)->delete();

        return redirect(route('vehicles'));
    }
}
