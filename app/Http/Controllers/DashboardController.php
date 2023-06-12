<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard');
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
    public function test()
    {
        $awal = Carbon::now();
        $akhir = Carbon::now()->subMonths(3);
        $bahan = DB::table('product')
            ->join('transaction', 'product.id', '=', 'transaction.product_id')
            ->whereBetween('transaction_date', [$akhir, $awal])
            ->groupBy('transaction.product_id')
            ->get();


        echo $awal . '<br>' . $akhir;
        // echo $bahan;
        //Mencari nilai total harga jual semua produk
        $totalpenjualanPP = DB::table('product')
            ->selectRaw("product_id, sum(sell_price * quantity) as totalpp")
            ->join('transaction', 'product.id', '=', 'transaction.product_id')
            ->whereBetween('transaction_date', [$akhir, $awal])
            ->groupBy('transaction.product_id')
            ->get();

        $totalpenjualanSP = 0;
        foreach ($totalpenjualanPP as $tpp) {
            $totalpenjualanSP += $tpp->totalpp;
        }
        // $totalpenjualanSP = whereBetween('transaction_date', [$awal, $akhir]);
        // dd($totalpenjualanSP);
        // dd($bahan);


        foreach ($totalpenjualanPP as $b) {
            $precentage[$b->product_id] = $b->totalpp / $totalpenjualanSP * 100;
        }
        echo $precentage[2];


        $Kl = new Collection();
        $kumulatif = 0;
        foreach ($bahan as $b) {
            $kumulatif += $precentage[$b->product_id];
            $Kl->push([
                'name' => $b->name,
                'precentage' => $precentage[$b->product_id],
                'kumulatif' => $kumulatif,
            ]);
        }


        $sortedKl = $Kl->sortByDesc('precentage')->values();
        // $sortedKl->dump();
        dd($sortedKl);


        $n = 0;
        foreach ($sortedKl as $sK) {
            //
        }
    }
}
