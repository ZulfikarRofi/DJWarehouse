<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\Placement;
use App\Models\Product;
use App\Models\Rack;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        $rack =
            // Rack::all();
            DB::table('rack')
            ->join('location', 'rack.location_id', '=', 'location.id')
            ->join('category', 'rack.category_id', '=', 'category.id')
            ->join('warehouse', 'location.warehouse_id', '=', 'warehouse.id')
            ->get();
        $product = Product::all();
        $category = Category::all();
        $placement = DB::table('placement')
            ->join('product', 'placement.product_id', '=', 'product.id')
            ->join('rack', 'placement.rack_id', '=', 'rack.id')
            ->get();

        $bahanTG = DB::table('warehouse')
            ->join('location', 'location.warehouse_id', '=', 'warehouse.id')
            ->get();
        // $productFG = DB::table('product')
        // dd($bahanTG);
        // dd($rack);

        $bahan = DB::table('transaction')
            ->join('product', 'transaction.product_id', '=', 'product.id')
            ->get();

        // dd($bahan);

        $result = new Collection();

        foreach ($bahan as $b) {
            $a = DB::table('transaction')->where('product_id', $b->product_id)->get();
            $buy = 0;
            $sell = 0;
            foreach ($a as $as) {
                if ($as->type == 'buy') {
                    $buy += $as->quantity;
                } else if ($as->type == 'sell') {
                    $sell += $as->quantity;
                }
            }
            $final = $buy - $sell;

            if ($result->where('name', $b->name)->count() === 0) {
                $result->push([
                    'id' => $b->transaction_id,
                    'name' => $b->name,
                    'image' => $b->image,
                    'stock' => $final,
                    'total_sell' => $sell,
                    'product_number' => $b->product_number,
                ]);
            }
        }

        // dd($result);

        return view('pages.warehouse', compact('rack', 'product', 'wh', 'lc', 'bahanTG', 'result', 'category', 'placement'));
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
            ]
        );

        $wh = new Warehouse();
        $wh->warehouse_name = $request->warehouse_name;
        $whid = DB::table('warehouse')->orderByDesc('created_at')->orderByDesc('updated_at')->pluck('id')->first();
        $whid2 = $whid + 1;
        $wh->registered_date = Carbon::now();
        $wh->warehouse_id = 'GD' . str_pad($whid2, 3, '0', STR_PAD_LEFT);
        $wh->status = 'other';
        $wh->save();
        // dd($wh);

        return redirect('/warehouses')->with('success', 'Gudang Baru Berhasil diTambahkan');
    }

    public function destroyWh($id)
    {
        $wh = Warehouse::find($id);
        $wh->delete();

        return redirect('/warehouses')->with('success', 'Data Gudang Berhasil Dihapus');
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

        return redirect()->back()->with('success', 'Lokasi Baru Berhasil Ditambahkan');
    }

    public function destroyLc($id)
    {
        $lc = Location::find($id);
        $lc->delete();

        return redirect()->back()->with('success', 'Data Lokasi Berhasil Dihapus');
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            // 'category_number' => 'required',
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $regis_date = Carbon::now();
        $idSebelum = DB::table('category')->orderByDesc('created_at')->orderByDesc('updated_at')->pluck('id')->first();
        $category->category_number = 'CT' . Carbon::parse($regis_date)->format('Ymd') . str_pad($idSebelum + 1, 3, '0', STR_PAD_LEFT);
        $category->save();

        // dd($category);

        return redirect()->back();
    }

    public function getRacks($id)
    {
        $lc = DB::table('location')
            ->where('warehouse_id', $id)
            ->get();


        $ct = Category::all();
        $wh = Warehouse::find($id);
        $rk = Rack::all()->groupBy('location_id');

        $groupedRack = [];

        foreach ($rk as $r => $innerArray) {
            $groupedRack[$r] = $innerArray;
        }

        $groupedSpecRack = [];
        foreach ($groupedRack as $gr => $innerArray2) {
            $groupedSpecRack[$gr] = $innerArray2;
        }


        // dd($groupedRack);

        // dd($rk[8]);
        return view('pages.masterrack', compact('lc', 'wh', 'ct', 'groupedRack', 'rk'));
    }


    public function addRackStore(Request $request)
    {
        $newRack = new Rack();
        $newRack->location_id = $request->location_id;
        $newRack->name = $request->name;
        $getlastId = DB::table('rack')->where('location_id', $request->location_id)->count();
        $prepName = strtoupper(substr($request->location_name, 0, 3));
        $rackNumber = str_pad($getlastId + 1, 3, '0', STR_PAD_LEFT);
        $newRack->rack_id = $prepName . '-' . $rackNumber;
        $newRack->category_id = $request->category_id;
        $newRack->registered_date = Carbon::now();
        $newRack->capacity = $request->capacity;
        $newRack->save();

        // dd($newRack);

        return redirect()->back()->with('success', 'Data Rak Baru Telah Ditambahkan');
    }

    public function addProducttoRack(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rack_id' => 'required',
        ]);

        $addProduct = DB::table('product')->where('id', $request->product_id)->first();
        if ($addProduct) {
            DB::table('product')->where('id', $request->product_id)->update([
                'rack_id' => $request->rack_id
            ]);
        }

        // dd($addProduct);
        return redirect()->back()->with('success', 'Berhasil Tambahkan Produk Pada Rak');
    }

    public function storeAddPlacement(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'rack_id' => 'required',
        ]);

        $placement = new Placement();
        $stampDate = Carbon::now();
        $stampId = DB::table('placement')->orderByDesc('created_at')->orderByDesc('updated_at')->pluck('id')->first();
        $placement->product_id = $request->product_id;
        $placement->rack_id = $request->rack_id;
        $placement->placement_id = 'PLC' . Carbon::parse($stampDate)->format('Ymd') . str_pad($stampId + 1, 3, '0', STR_PAD_LEFT);
        $placement->save();


        // dd($placement);

        return redirect()->back();
    }

    public function getSelectedRack($id)
    {
        $rack = Rack::find($id);
        $product = DB::table('product')->where('rack_id', $id)->get();
        $products = Product::all();

        return view('pages.detailrack', compact('rack', 'products', 'product'));
    }

    public function classification(Request $request)
    {
        $request->validate([
            'duration' => 'required',
        ]);


        $awal = Carbon::now();
        $akhir = Carbon::now()->subMonths($request->duration);
        $bahan = DB::table('product')
            ->join('transaction', 'product.id', '=', 'transaction.product_id')
            ->whereBetween('transaction_date', [$akhir, $awal])
            // ->groupBy('transaction.product_id')
            ->get();

        // if ($->where('name', $b->name)->count() === 0)

        echo $awal . '<br>' . $akhir;
        // echo $bahan;
        //Mencari nilai total harga jual semua produk
        $totalpenjualanPP = DB::table('product')
            ->selectRaw("product_id, name, product_number, sum(sell_price * quantity) as totalpp")
            ->join('transaction', 'product.id', '=', 'transaction.product_id')
            ->whereBetween('transaction_date', [$akhir, $awal])
            ->groupBy('transaction.product_id', 'name', 'product_number')
            ->get();

        $totalpenjualanSP = 0;
        foreach ($totalpenjualanPP as $tpp) {
            $totalpenjualanSP += $tpp->totalpp;
        }

        $precentage = array();
        foreach ($totalpenjualanPP as $b) {
            $precentage[$b->product_id] = $b->totalpp / $totalpenjualanSP * 100;
        }

        arsort($precentage);

        $Kl = new Collection();
        $kumulatif = 0;
        $bahanTpp = $totalpenjualanPP->sortByDesc('totalpp');
        // dd($bahanTpp);
        foreach ($bahanTpp as $b) {
            if ($Kl->where('product_id', $b->product_id)->count() === 0) {
                $kumulatif += $precentage[$b->product_id]; {
                    $Kl->push([
                        'product_name' => $b->name,
                        'product_id' => $b->product_id,
                        'product_number' => $b->product_number,
                        'totalpp' => $b->totalpp,
                        'totalsp' => $totalpenjualanSP,
                        'precentage' => $precentage[$b->product_id],
                        'kumulatif' => $kumulatif,
                    ]);
                }
            }
        }

        // dd($Kl);
        $Kl2 = new Collection();
        foreach ($Kl as $newKl) {
            if ($newKl['kumulatif'] <= 75) {
                $Kl2->push([
                    'product_name' => $newKl['product_name'],
                    'product_id' => $newKl['product_id'],
                    'product_number' => $newKl['product_number'],
                    'totalpp' => $newKl['totalpp'],
                    'totalsp' => $newKl['totalsp'],
                    'precentage' => $newKl['precentage'],
                    'kumulatif' => $newKl['kumulatif'],
                    'class' => 'A',
                ]);
            } else if ($newKl['kumulatif'] <= 95) {
                $Kl2->push([
                    'product_name' => $newKl['product_name'],
                    'product_id' => $newKl['product_id'],
                    'product_number' => $newKl['product_number'],
                    'totalpp' => $newKl['totalpp'],
                    'totalsp' => $newKl['totalsp'],
                    'precentage' => $newKl['precentage'],
                    'kumulatif' => $newKl['kumulatif'],
                    'class' => 'B',
                ]);
            } else {
                $Kl2->push([
                    'product_name' => $newKl['product_name'],
                    'product_id' => $newKl['product_id'],
                    'product_number' => $newKl['product_number'],
                    'totalpp' => $newKl['totalpp'],
                    'totalsp' => $newKl['totalsp'],
                    'precentage' => $newKl['precentage'],
                    'kumulatif' => $newKl['kumulatif'],
                    'class' => 'C',
                ]);
            }
        }

        // dd($bahan);

        $finalKl = new Collection();

        foreach ($Kl2 as $newKl2) {
            $finalKl->push([
                'product_name' => $newKl2['product_name'],
                'product_id' => $newKl2['product_id'],
                'product_number' => $newKl2['product_number'],
                'totalpp' => $newKl2['totalpp'],
                'totalsp' => $newKl2['totalsp'],
                'precentage' => $newKl2['precentage'],
                'kumulatif' => $newKl2['kumulatif'],
                'class' => $newKl2['class'],
            ]);
        }

        // dd($finalKl);

        $formatAwal = Carbon::parse($awal)->isoFormat('Do MMMM YYYY');
        $formatAkhir = Carbon::parse($akhir)->isoFormat('Do MMMM YYYY');
        return view('pages.detailclassification', compact('formatAwal', 'formatAkhir'))->with('finalKl', $finalKl);
    }

    public function getWarehouse()
    {
        $wh = Warehouse::all();

        return view('pages.masterwarehouse', compact('wh'));
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
