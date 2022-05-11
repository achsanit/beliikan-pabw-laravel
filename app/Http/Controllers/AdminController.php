<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function home()
    {
        $totalProducts = Product::count();
        $totalTransactions = Transaction::count();
        $totalUsers = User::count();
        $totalEarning = Transaction::where('status', 'selesai')->sum('total_price');
        $newOrder = Transaction::where('status', 'pending')->get();
        $newProduct = Product::latest('id')->take(5)->get();
        // dd($newOrder);
        
        return view('admin.dashboard', compact('totalProducts', 'totalUsers', 'totalTransactions', 'totalEarning', 'newOrder', 'newProduct'));
    }

    public function order()
    {
        $confirm = Transaction::where('status', 'pending')->get();
        $shipping = Transaction::where('status', 'proses')->get();
        $arrived = Transaction::where('status', 'selesai')->get();
        $cancel = Transaction::where('status', 'batal')->get();

        return view('admin.dataOrderan', compact('confirm', 'shipping', 'arrived','cancel'));
    }

    public function confirm($id)
    {
        Transaction::where('id', $id)->update(['status' => 'proses']);

        $detailProduct = DetailTransaction::where('transaction_id', $id)->get();
        // dd($detailProduct);

        foreach ($detailProduct as $product) {
            $oldProduct = Product::where('id',$product->product_id)->first();
            if ($oldProduct) {
                $oldProduct->update(['stock' => $oldProduct->stock - $product->qty]);
            }else{
                return redirect()->back('gagal', 'produk tidak ada');
            }
        }
        return redirect()->back()->with('confirm', 'konfirmasi telah dilakukan');
    }

    public function arrived($id)
    {
        Transaction::where('id', $id)->update(['status' => 'selesai']);

        return redirect()->back()->with('confirm', 'pesanan telah sampai');
    }

    public function reject($id)
    {
        Transaction::where('id', $id)->update(['status' => 'batal']);

        return redirect()->back()->with('confirm', 'konfirmasi telah dilakukan');
    }
}
