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
            // ->groupBy('transaction.product_id')
            ->get();

        // if ($->where('name', $b->name)->count() === 0)

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

        $precentage = array();
        foreach ($totalpenjualanPP as $b) {
            $precentage[$b->product_id] = $b->totalpp / $totalpenjualanSP * 100;
        }

        arsort($precentage);

        $Kl = new Collection();
        $kumulatif = 0;
        $bahanTpp = $totalpenjualanPP->sortByDesc('totalpp');
        foreach ($bahanTpp as $b) {
            if ($Kl->where('product_id', $b->product_id)->count() === 0) {
                $kumulatif += $precentage[$b->product_id]; {
                    $Kl->push([
                        'product_id' => $b->product_id,
                        'precentage' => $precentage[$b->product_id],
                        'kumulatif' => $kumulatif,
                    ]);
                }
            }
        }

        $Kl2 = new Collection();
        foreach ($Kl as $newKl) {
            if ($newKl['kumulatif'] <= 75) {
                $Kl2->push([
                    'product_id' => $newKl['product_id'],
                    'precentage' => $newKl['precentage'],
                    'kumulatif' => $newKl['kumulatif'],
                    'class' => 'A',
                ]);
            } else if ($newKl['kumulatif'] <= 95) {
                $Kl2->push([
                    'product_id' => $newKl['product_id'],
                    'precentage' => $newKl['precentage'],
                    'kumulatif' => $newKl['kumulatif'],
                    'class' => 'B',
                ]);
            } else {
                $Kl2->push([
                    'product_id' => $newKl['product_id'],
                    'precentage' => $newKl['precentage'],
                    'kumulatif' => $newKl['kumulatif'],
                    'class' => 'C',
                ]);
            }
        }

        // dd($bahan);

        $finalKl = new Collection();

        foreach ($Kl2 as $newKl2) {
            $stampBahan = DB::table('product')->select('name')->where('id', $newKl2['product_id'])->get();
            $finalKl->push([
                'name' => $stampBahan[0],
                'product_id' => $newKl2['product_id'],
                'precentage' => $newKl2['precentage'],
                'kumulatif' => $newKl2['kumulatif'],
                'class' => $newKl2['class'],
            ]);
        }

        dd($finalKl);
    }
}
