<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartnersController extends Controller
{
    public function getPartners()
    {
        $part = Partners::all();

        return view('pages.partnersdata', compact('part'));
    }

    public function exStorePartners()
    {
        $newPart = new Partners();
        $newPart->partners_name = 'PT. Adi Jaya';
        $newPart->partners_ID = 'SP_001';
        $newPart->address = 'Mojokerto';
        $newPart->type = 'supplier';
        $newPart->phone_number = '0855648853152';
        $newPart->save();

        $newPart = new Partners();
        $newPart->partners_name = 'PT. Sumber Rejeki';
        $newPart->partners_ID = 'SP_002';
        $newPart->address = 'Bandung';
        $newPart->type = 'supplier';
        $newPart->phone_number = '08122564859302';
        $newPart->save();

        $newPart = new Partners();
        $newPart->partners_name = 'PT. Naga Mas';
        $newPart->partners_ID = 'SP_003';
        $newPart->address = 'Gresik';
        $newPart->type = 'supplier';
        $newPart->phone_number = '084585641523';
        $newPart->save();

        dd($newPart);
    }

    public function partners()
    {
        $partners = Partners::find(1);
        dd($partners->product);
    }

    public function test()
    {
        $product = Product::find(1);
        dd($product->product_partners);
    }

    public function storePartnersProduct()
    {
        $partners = Partners::find(1);
        $partners->product()->attach([1, 2, 3]);

        dd($partners);
    }

    public function sTP()
    {
        $transaction = Transaction::find(1);
        $transaction->partners()->attach([1, 2, 3]);

        dd($transaction->partners);
    }

    public function sPT()
    {
        $partners = partners::find(1);
        $partners->transaction()->attach([1, 2, 3]);

        dd($partners->transaction);
    }

    public function storeProductPartners()
    {
        $product = Product::find(1);
        $product->product_partners()->attach([1, 2, 3]);
    }

    public function getProductsPartner($id)
    {
        $partners = Partners::find($id);

        $getP = DB::table('partners')->select('partners_name')->where('id', $id)->get();
        $x = new Collection();

        if ($partners) {
            $product = $partners->product;

            foreach ($product as $p) {
                $x->push([
                    'name' => $p->name,
                    'colors' => $p->colors,
                    'product_number' => $p->product_number,
                ]);
            }
        } else {
            echo 'No Item';
        }

        // dd($getP[0]);

        return view('pages.productspartner', compact('x', 'getP'));
    }

    public function getPartnersProduct($id)
    {
        $product = Product::find($id);
        $getP = DB::table('product')->select('name')->where('id', $id)->get();

        $y = new Collection();

        if ($product) {
            $partners = $product->product_partners;

            foreach ($partners as $pr) {
                $y->push([
                    'partner_name' => $pr->partners_name,
                    'partner_id' => $pr->partners_ID,
                    'address' => $pr->address,
                ]);
            }
        } else {
            echo 'no item recorded';
        }

        // dd($y);

        return view('pages.partnersproduct', compact('y', 'getP'));
    }

    public function getPartnersTransaction($id)
    {
        $transaction = Transaction::find($id);

        $y = new Collection();

        if ($transaction) {
            $partners = $transaction->partners;

            foreach ($partners as $pr) {
                $y->push([
                    'partner_name' => $pr->partners_name,
                    'partner_id' => $pr->partners_ID,
                    'address' => $pr->address,
                ]);
            }
        } else {
            echo 'no item recorded';
        }

        // dd($y);
        return view('pages.partnerstransaction', compact('y'));
    }

    public function getTransactionsPartner($id)
    {
        $partners = Partners::find($id);
        $getP = DB::table('partners')->select('partners_name')->where('id', $id)->get();

        $z = new Collection();

        if ($partners) {
            $transaction = $partners->transaction;

            foreach ($transaction as $tr) {
                $z->push([
                    'transaction_id' => $tr->transaction_id,
                    'transaction_date' => $tr->transaction_date,
                    'type' => $tr->type,
                    'note' => $tr->note,
                    'quantity' => $tr->quantity,
                ]);
            }
        }

        // dd($z);

        return view('pages.transactionspartner', compact('z', 'getP'));
    }
}
