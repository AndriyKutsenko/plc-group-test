<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $items = DB::table('delivery_costs')
            ->select('delivery_costs.*', 'countries.name as country_name')
            ->join('countries', 'delivery_costs.country_id', '=', 'countries.id')
            ->get();

        return view('admin.delivery.index', ['items' => $items]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $countries = DB::table('countries')->get();

        return view('admin.delivery.add', [
            'countries' => $countries,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $data = $request->post();

        DB::table('delivery_costs')->insert([
            'country_id' => $data['country'],
            'cost' => str_replace(',', '.', null !== $data['cost'] ? $data['cost'] : 0),
        ]);

        return redirect(route('delivery'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $item = DB::table('delivery_costs')->where('id', $request->id)->first();

        $countries = DB::table('countries')->get();

        return view('admin.delivery.edit', [
            'item' => $item,
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

        DB::table('delivery_costs')
            ->where('id', $request->id)
            ->update([
                'cost' => str_replace(',', '.', null !== $data['cost'] ? $data['cost'] : 0),
                'country_id' => $data['country'],
            ]);

        return redirect(route('delivery'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        DB::table('delivery_costs')->where('id', $request->id)->delete();

        return redirect(route('delivery'));
    }
}
