<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::table('product')->join('transaction', 'product_id', '=', 'product.id')->get();


        return view('pages.report', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSellReport()
    {
        $totalPP = DB::table('product')
            ->selectRaw('product_id, name, product_number, colors,product_id ,sell_price,sum(sell_price * quantity) as totalpp, sum(quantity) as total_jual')
            ->join('transaction', 'product_id', '=', 'product.id')
            ->where('type', 'sell')
            ->groupBy('name', 'product_number', 'colors', 'product_id', 'sell_price', 'transaction.product_id')
            ->get();

        $totalbelipp = DB::table('product')
            ->selectRaw('product_id, name, product_number, colors, product_id,buy_price,sum(buy_price * quantity) as totalpp, sum(quantity) as total_beli')
            ->join('transaction', 'product_id', '=', 'product.id')
            ->where('type', 'buy')
            ->groupBy('name', 'product_number', 'colors', 'product_id', 'buy_price', 'transaction.product_id')
            ->get();

        $bahan = DB::table('transaction')
            ->join('product', 'transaction.product_id', '=', 'product.id')
            ->get();

        // dd($totalbelipp);

        return view('pages.sellreport', compact('totalPP', 'bahan'));
    }

    public function getStockReport()
    {
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
                    'total_buy' => $buy,
                    'product_number' => $b->product_number,
                ]);
            }
        }
        // dd($result);
        return view('pages.stockreport', compact('result'));
    }

    public function getLogsReport()
    {
        // $logs = DB::table('afterlns_product')->join('product', 'afterlns_product.product_id', '=', 'product.id')->join('rack', 'afterlns_product.rack_id', '=', 'rack.id')->get();

        $log = DB::table('afterlns_product')->get();
        $reportLog = new Collection();
        foreach ($log as $logg) {
            $products = DB::table('product')->where('id', $logg->product_id)->first();
            $racks = DB::table('rack')->where('id', $logg->rack_id)->first();
            $nracks = DB::table('rack')->where('id', $logg->new_rack_id)->first();

            if (empty($logg->rack_id)) {
                if (empty($logg->new_rack_id)) {
                    $reportLog->push([
                        'product_name' => $products->name,
                        'product_number' => $products->product_number,
                        'product_color' => $products->colors,
                        'old_rack' => 'null',
                        'new_rack' => 'null',
                        'change_on' => $logg->change_on,
                    ]);
                } else {
                    $reportLog->push([
                        'product_name' => $products->name,
                        'product_number' => $products->product_number,
                        'product_color' => $products->colors,
                        'old_rack' => 'null',
                        'new_rack' => $nracks->name,
                        'change_on' => $logg->change_on,
                    ]);
                }
            }
            else {
                $reportLog->push([
                    'product_name' => $products->name,
                    'product_number' => $products->product_number,
                    'product_color' => $products->colors,
                    'old_rack' => $racks->name,
                    'new_rack' => $logg->new_rack_id,
                    'change_on' => $logg->change_on,
                ]);
            }
        }
        // dd($reportLog);

        return view('pages.placementlogsreport')->with('reportLog', $reportLog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
