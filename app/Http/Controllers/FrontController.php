<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $review = Review::paginate(10);
        return view('front.index', [
            'products' => $products,    
            'categories' => $categories,
            "review" => $review
        ]);
    }

    public function details(Product $product){
        $other_products = Product::where('id', '!=', $product->id)->get();
        $creator_id = $product->creator_id;
        $creator_products = Product::where('creator_id', $creator_id)->get();
        $review_product = Review::where("product_id", $product->id)->get();
        return view('front.details', [
            'product' => $product,
            'other_products' => $other_products,
            'creator_products' => $creator_products,
            'review_product' => $review_product
        ]);
    }

    public function category(Category $category){
        $product_categories = Product::where('category_id', $category->id)->get();
        $review_product = Review::all();
        return view('front.category', [
            'category' => $category,
            'product_categories' => $product_categories,
            'review_product' => $review_product
        ]);
    }

    public function search(Request $request){
        $keywoard = $request->input('keywoard');

        $products = Product::query()
        ->where('name', 'LIKE', '%' . $keywoard . '%')
        ->orWhereHas('category', function ($query) use ($keywoard){
            $query->where('name', 'LIKE', '%' . $keywoard . '%');
        })->get();

        return view('front.search', [
            'products' => $products
        ]);
    }
}
