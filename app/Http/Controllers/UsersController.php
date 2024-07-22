<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Models\Tools;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::where('role', 'user')->orderBy("created_at", "desc")->get();
        return view('superadmin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('superadmin.users.edit', compact('user'));
    }

    public function suspend(User $user)
    {
        //
        $updatedUser = $user->update([
            'suspanded' => true
        ]);
       
        return redirect()->route('superadmin.users.index');
    }

    public function recovery(User $user)
    {
        //
        $user->update([
            'suspanded' => false
        ]);
        return redirect()->route('superadmin.users.index');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolRequest $request, Tools $user)
    {
        //
        DB::transaction(function() use ($request, $user) {
            $validated = $request->validated();

            if($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('users', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $user->update($validated);
        });

        return redirect()->route('superadmin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //


        DB::beginTransaction();

        try{
            $user->delete();
            DB::commit();
            return redirect()->route('superadmin.users.index');
        }catch(\Exception $e){
                DB::rollback();
                return redirect()->route('superadmin.users.index');
        }
    }
}
