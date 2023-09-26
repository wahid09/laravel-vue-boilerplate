<?php

namespace App\Http\Controllers\Backend\Division;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::with('parent')->get();
        return $divisions;
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
        dd($request->all());
        request()->validate([
            'division_name' => 'required',
            'division_code' => 'required',
            'order' => 'required|unique:divisions,order',
        ]);

        return Division::create([
            'division_name' => request('division_name'),
            'division_code' => request('division_code'),
            'order' => request('order'),
            'is_active' => request('is_active'),
        ]);
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
