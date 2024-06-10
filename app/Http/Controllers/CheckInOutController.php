<?php

namespace App\Http\Controllers;

use App\Models\Check_in_out;
use App\Models\Guest;

use Illuminate\Http\Request;

class CheckInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function checkout(Request $request,$id)
    {
        //
        $check_in_out = Check_in_out::find($id);
        // dd($check_in_out['checkout'] = date($check_in_out['updated_at']));
        // dd($check_in_out);

        $guest = Guest::find($check_in_out['guest_id']);
        // dd($request->no_telp);
        $guest->update([
            'no_telp' => $request->no_telp,
            ]);

        $check_in_out->update([
            'checkin' => null,
            'checkout' => date(now()),
            ]);
            
        return redirect()->back()->with('success','Terimakasih Telah Berkunjung');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Check_in_out $check_in_out)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Check_in_out $check_in_out)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Check_in_out $check_in_out)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Check_in_out $check_in_out)
    {
        //
    }
}
