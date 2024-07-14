<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tools;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $products = Product::whereHas('creator', function ($query) {
            $query->where('suspanded', false);
        })->get();
        $newproducts = Product::whereHas('creator', function ($query) {
            $query->where('suspanded', false);
        })->orderby('created_at','desc')->take(4)->get();
        $categories = Category::all();
        $review = Review::paginate(10);

        // dd($newproducts);
        return view('front.index', [
            'products' => $products,
            'newproducts' => $newproducts,    
            'categories' => $categories,
            "review" => $review
        ]);
    }

    public function suspend() {
        $categories = Category::all();

        return view('front.supend', [
            'categories' => $categories,
        ]);
    }

    public function list_product(Request $request)
    {
        $query = Product::query();
    
        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'created_at_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }
    
        $products = $query->get();
        $categories = Category::all();

        return view('front.list_product', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
    
    public function sort_product(Request $request)
    {
        return redirect()->route('front.list_product', ['sort' => $request->input('sort')]);
    }

    public function details(Product $product){
        $other_products = Product::where('id', '!=', $product->id)->get();
        $creator_id = $product->creator_id;
        $categories = Category::all();
        $creator_products = Product::where('creator_id', $creator_id)->get();
        $review_product = Review::where("product_id", $product->id)->get();

        return view('front.details', [
            'product' => $product,
            'other_products' => $other_products,
            'creator_products' => $creator_products,
            'review_product' => $review_product,
            'categories' => $categories
        ]);
    }

    public function category(Category $category){
        $product_categories = Product::where('category_id', $category->id)->get();
        $categories = Category::all();
        $review_product = Review::all();
        return view('front.category', [
            'category' => $category,
            'categories' => $categories,
            'product_categories' => $product_categories,
            'review_product' => $review_product
        ]);
    }

    public function search(Request $request){
        $keywoard = $request->input('keywoard');
        $categories = Category::all();
        $products = Product::query()
        ->where('name', 'LIKE', '%' . $keywoard . '%')
        ->orWhereHas('category', function ($query) use ($keywoard){
            $query->where('name', 'LIKE', '%' . $keywoard . '%');
        })->get();

        return view('front.search', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
