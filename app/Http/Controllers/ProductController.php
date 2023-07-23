<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $bahan = DB::table('transaction')
            ->join('product', 'transaction.product_id', '=', 'product.id')
            ->get();

        // dd($bahan);

        $result = new Collection();

        $product = Product::all();

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
                    'product_number' => $b->product_number,
                    'product_type' => $b->product_type,
                    'type' => $b->type,
                    'quality' => $b->type,
                    'size' => $b->size,
                    'merk' => $b->merk,
                    'colors' => $b->colors,
                    'sell_price' => $b->sell_price,
                    'buy_price' => $b->buy_price,
                ]);
            }
        }

        return view('pages.productdata', compact('result', 'product'));
    }

    public function classification()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => '',
            'product_type' => 'required',
            'merk' => 'required',
            'quality' => 'required',
            'size' => 'required',
            'colors' => 'required',
            'buy_price' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $bahanAwalID = DB::table('product')->orderBy('id', 'desc')->first()->id;
        $product->product_number = 'KR_' . Carbon::parse(Carbon::now())->format('Ymd') . $bahanAwalID + 1;
        $product->product_type = $request->product_type;
        $product->quality = $request->quality;
        $product->size = $request->size;
        $product->merk = $request->merk;
        $product->colors = $request->colors;
        $product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;
        if ($request->file('image')) {
            $file = $request->file('image');
            $image_name = time() . str_replace(" ", "", $file->getClientOriginalName());
            $file->move('image', $image_name);
            $product->image = $image_name;
        }
        $product->save();
        // dd($product);
        return redirect('/products')->with('success', 'Produk Baru Telah Ditambahkan');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Produk Terpilih Berhasil Dihapus');
    }
}
