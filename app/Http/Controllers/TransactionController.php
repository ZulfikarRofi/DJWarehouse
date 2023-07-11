<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Trait_;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $transaction = DB::table('product')->join('transaction', 'product_id', '=', 'product.id')->get();
        // $transaction = Transaction::all();
        // dd($transaction);
        return view('pages.transactiondata', compact('transaction', 'product'));
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
        $request->validate([
            'product_id' => 'required',
            'note' => 'required',
            'type' => 'required',
            'transaction_date' => 'required',
            'quantity' => 'required',
        ]);

        $bahanAwalID = DB::table('transaction')->orderBy('id', 'desc')->first()->id;
        $bahanID = $bahanAwalID + 1;
        $trans = new Transaction();
        $trans->product_id = $request->product_id;
        $trans->note = $request->note;
        $trans->type = $request->type;
        if ($trans->type == 'buy') {
            $typeNumber = 'BL';
        } elseif ($trans->type == 'sell') {
            $typeNumber = 'SL';
        }
        $trans->transaction_date = $request->transaction_date;
        $trans->quantity = $request->quantity;
        $trans->transaction_id = $typeNumber .  Carbon::parse($trans->transaction_date)->format('Ymd') . $bahanID;
        $trans->save();
        // dd($bahanID);
        // dd($trans);

        return redirect('/transactions')->with('success', 'Transaksi Baru Telah Ditambahkan');
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
        $trans = Transaction::find($id);
        $trans->delete();

        return redirect('/transactions')->with('success', 'Transaksi Terpilih Berhasil Dihapus');
    }
}
