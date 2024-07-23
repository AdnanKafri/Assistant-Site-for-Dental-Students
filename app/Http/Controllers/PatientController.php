<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PatientController extends Controller
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
    public function create(): View
    {
//        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
//        dd($request -> all());
//        $validatedData = $request->validate([
//            'Address' => 'required|string',
//            'age' => 'required|integer',
//            'post_timer' => 'nullable|string',
//        ]);
//
//        $patient=Patient::create([
//            'p_id' => $request->user->id,
//            'Address' => $validatedData['Address'],
//            'age' => $validatedData['age'],
//            'post_timer' => $validatedData['post_timer'],
//        ]);
//
//        event(new Registered($patient));
//
//        Auth::login($patient);
//
//        return redirect(RouteServiceProvider::HOME);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
