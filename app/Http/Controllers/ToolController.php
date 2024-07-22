<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Models\Tools;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tools= Tools::orderBy("created_at", "desc")->get();
        return view('superadmin.tools.index', compact('tools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('superadmin.tools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolRequest $request)
    {
        //
       DB::transaction(function() use ($request) {
            $validated = $request->validated();

            if($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('tools', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

              $newTool = Tools::create($validated);
             
        });

        return redirect()->route('superadmin.tools.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tools $Tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tools $tool)
    {
        //
        return view('superadmin.tools.edit', compact('tool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolRequest $request, Tools $tool)
    {
        //
        DB::transaction(function() use ($request, $tool) {
            $validated = $request->validated();

            if($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('tools', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $tool->update($validated);
        });

        return redirect()->route('superadmin.tools.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tools $tool)
    {
        //


        DB::beginTransaction();

        try{
            $tool->delete();
            DB::commit();
            return redirect()->route('superadmin.tools.index');
        }catch(\Exception $e){
                DB::rollback();
                return redirect()->route('superadmin.tools.index');
        }
    }
}
