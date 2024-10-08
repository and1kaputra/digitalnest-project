<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    //
    public function checkout(Product $product){
        $categories = Category::all();
        return view('front.checkout', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request, Product $product){
         // validasi agar pembeli tidak membeli produknya sendiri
         if($product->creator_id === Auth::id()){
            $error = ValidationException::withMessages([
                'system_error' => ['Do not buy your own product'],
            ]);
            throw $error;
         }

         $validated = $request->validate([
            'proof' => 'required|image|mimes:png,jpg,jpeg|max:2048',
         ]);

         if($request->hasFile('proof')){
            $proofPath = $request->file('proof')->store('payment_proofs', 'public');
            $validated['proof'] = $proofPath;
        }

        $data = [
            'total_price' => $product->price,
            'is_paid' => "pending",
            'buyer_id' => Auth::id(),
            'creator_id' => $product->creator_id,
            'product_id' => $product->id,
            'proof' => $validated['proof'],
        ];

        DB::beginTransaction();

        try{

            $newOrder = ProductOrder::firstOrCreate($data);

            DB::commit();

            return redirect()->route('creator.product_orders.transactions')->with('success','Success checkout successfuly!');
        }
        catch(\Exception $e){
            DB::rollback();

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
