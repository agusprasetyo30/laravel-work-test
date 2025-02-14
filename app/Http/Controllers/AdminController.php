<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('user_login')) {
            // abort(409, "You are already logged in!");
            return redirect()->route('admin.master.index');
        }
        
        return view('admin.index');
    }

    /**
     * Digunakan untuk login sebagai admin
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function adminLogin(Request $request)
    {
        $get_data = Admin::where('email', $request->email)->first();
        
        if($get_data) {
            $get_data->role = 'admin';

            session(['user_login' => $get_data]);

            return redirect()->route('admin.master.index');
            // dd($get_data, $get_data->role);
        }
        
        return redirect()->route('admin.index')
            ->with('alert_type', 'error')
            ->with('message', 'Email not found!');
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
