<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Stock;
use App\Models\Perfume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perfumes = Perfume::orderBy('id', 'desc')->paginate(6);
        $stock = Stock::all();

        return Inertia::render('Dashboard', [
            'perfumes' => $perfumes,
            'stock' => $stock
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $ml_perfume = $request->ml_water + $request->ml_alcohol + $request->ml_fragrance;
        
        //dd($ml_perfume);
        Perfume::create([
            'name' => $request->name,
            'ml_perfume' => $ml_perfume,
            'ml_water' => $request->ml_water,
            'ml_alcohol' => $request->ml_alcohol,
            'ml_fragrance' => $request->ml_fragrance,         
            'name_fragrance' => $request->name_fragrance,
            'ml_most_used_fragrance' => 0,
            'amount_created' => 0,
            'quantity_available_for_breeding' => 0
        ]);

        return Redirect::route('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
