<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToolProductRequest;
use App\Http\Requests\StoreToolProjectRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\ProductTool;
use App\Models\ProjectTool;
use App\Models\Review;
use App\Models\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::where('creator_id', Auth::id())->get();
        return view('creator.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tools = Tools::all();
        return view('creator.products.create', [
            'categories' => $categories,
            'tools' => $tools
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'image', 'mimes:png,jpg,jpeg'],
            'path_file' => ['required', 'file', 'mimes:zip'],
            'about' => ['required', 'string', 'max:65535'],
            'category_id' => ['required', 'integer'],
            'tool_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:5'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        DB::beginTransaction();

        try{
            if($request->hasFile('cover')){
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            if($request->hasFile('path_file')){
                $path_filePath = $request->file('path_file')->store('product_files', 'public');
                $validated['path_file'] = $path_filePath;
            }
            $validated['slug'] = Str::slug($request->name);
            $validated['creator_id'] = Auth::id();
            $newProduct = Product::create($validated);
            DB::commit();

            return redirect()->route('creator.products.index')->with('success','Product created successfuly!');
        }
        catch(\Exception $e){
            DB::rollback();

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    public function product_tools(Product $product) {
        $tools = Tools::all();


        return view('creator.products.tool', compact('tools', "product"));;
    }




    public function product_tool_store(StoreToolProductRequest $request, Product $product)
    {
        
        DB::transaction(function () use ($request, $product) {
            $validated = $request->validated();
            $validated["product_id"] = $product->id;

            $toolProject = ProductTool::firstOrCreate($validated);
        });

        return redirect()->route('creator.product.tools', $product->id);


    }

    public function rating(Request $request, Product $product) {
        $user = Auth::user();
        $validated = $request->validate([
            "stars" => 'required',
            "review" => "required"
        ]);

        DB::beginTransaction();

        try{

            $exitsReveiew = Review::where('reviewer_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

            if ($exitsReveiew) {
                session()->flash('errorReview', 'You have filled out the review');
                return redirect()->back();
            }

            $newProduct = Review::create([
                "reviewer_id" => $user->id,
                "product_id" => $product->id,
                "stars" => $validated["stars"],
                "review" => $validated["review"]
            ]);

            DB::commit();

            return redirect()->route('front.details', $product->slug);
        }
        catch(\Exception $e){
            DB::rollback();

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();
        $tools = Tools::all();
        return view('creator.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'tools' => $tools
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'path_file' => ['sometimes', 'file', 'mimes:zip'],
            'about' => ['required', 'string', 'max:65535'],
            'category_id' => ['required', 'integer'],
            'tool_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:5'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        DB::beginTransaction();

        try{

            if($request->hasFile('cover')){
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }
            if($request->hasFile('path_file')){
                $path_filePath = $request->file('path_file')->store('product_files', 'public');
                $validated['path_file'] = $path_filePath;
            }

            $validated['slug'] = Str::slug($request->name);
            $validated['creator_id'] = Auth::id();

            $product->update($validated);

            DB::commit();

            return redirect()->route('creator.products.index')->with('success','Product created successfuly!');
        }
        catch(\Exception $e){
            DB::rollback();

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
}

public function destroy_product_tool(ProductTool $productTool)
{
    //

    DB::beginTransaction();

    try{
        $productTool->delete();
        DB::commit();
        return redirect()->route('creator.product.tools', $productTool->product_id);
    }catch(\Exception $e) {
            DB::rollback();
            return redirect()->route('creator.product.tools', $productTool->product_id);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        try{
            $product->delete();
            return redirect()->route('creator.products.index')->with('success','Product deleted successfuly!');
        }
        catch(\Exception $e){

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);

            throw $error;
        }
    }
}
