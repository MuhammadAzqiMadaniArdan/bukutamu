<?php

namespace App\Http\Controllers;

use App\Models\Rack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
    public function authLogin(Request $request)
    {
        $request->validate([
            // email dns digunakan untuk mengecek user apakah memeiliki alamt google,yahoo dll yang bersifat dns
            'email' => 'required',
            // 'email' => 'required|email:dns',
            'password' => 'required',

        ]);
        // simpan data dari dalam email dan password ke dalam variabel untuk memudahkan panggilan 
        $user = $request->only(['email', 'password']);
        // mengecek kecocokkan email dan password kemudian menyimopannya d dalam class beranama auth(memberi didentitas data riwayat login ke project)
        if (Auth::attempt($user)) {
            return redirect('/dashboard')->with('success', 'Login Berhasil!');
            // perbedaan redirecxt dan route 
        } else {
            return redirect()->back()->with('failed', 'Login gagal! silakan coba lagi');
        }
    }

    
    public function logout()
    {
        // menghapus atau menghilangkan data session login 
        Auth::logout();
        return redirect()->route('login');
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
