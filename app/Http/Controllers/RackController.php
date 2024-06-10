<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use App\Models\Datacenter;
use Illuminate\Http\Request;

class RackController extends Controller
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
        $datacenters = Datacenter::orderBy('name','ASC')->get();
        return view('admin.rack.index',compact('datacenters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'datacenter' => 'required',
        ]);


        Rack::create([
            'name' => $request->name,
            'datacenter_id' => $request->datacenter,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data Rack');

        
    }
    /**
     * Display the specified resource.
     */
    public function show(Rack $rack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rack $rack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rack $rack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rack $rack)
    {
        //
    }
}
