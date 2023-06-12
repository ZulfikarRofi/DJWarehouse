<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Product;
use App\Models\Rack;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lc = Location::all();
        $wh = Warehouse::all();
        $rack = Rack::all();
        $product = Product::all();
        // dd($wh);
        return view('pages.warehouse', compact('rack', 'product', 'wh', 'lc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'warehouse_name' => 'required|min:3',
                'registered_date' => 'required',
            ]
        );

        $wh = new Warehouse();
        $wh->warehouse_name = $request->warehouse_name;
        $whid = DB::table('warehouse')->orderByDesc('created_at')->orderByDesc('updated_at')->pluck('id')->first();
        $wh->registered_date = $request->registered_date;
        $wh->warehouse_id = 'GD' . '_' . 0 . $whid . '_' . Carbon::parse($wh->registered_date)->format('Ymd');
        $wh->status = 'other';
        $wh->save();
        // dd($wh);

        return redirect('/warehouses')->with('success', 'Gudang Baru Berhasil diTambahkan');
    }

    public function locationStore(Request $request)
    {
        $request->validate([
            'location_name' => 'required',
            'warehouse_id' => 'required',
        ]);

        $lc = new Location();
        $lc->location_name = $request->location_name;
        $lc->warehouse_id = $request->warehouse_id;
        $lc->save();
        // dd($lc);

        return redirect('/warehouses')->with('success', 'Lokasi Baru Berhasil Ditambahkan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
