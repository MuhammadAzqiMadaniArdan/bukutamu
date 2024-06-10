<?php

namespace App\Http\Controllers;

use App\Models\Datacenter;
use Illuminate\Http\Request;

class DatacenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.datacenter.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'location' => 'required',
        ]);
        // dd($request->name);
        Datacenter::create([
            'name' => $request->name,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data Datacenter');

    }

    /**
     * Display the specified resource.
     */
    public function show(Datacenter $datacenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Datacenter $datacenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Datacenter $datacenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Datacenter $datacenter)
    {
        //
    }
}
