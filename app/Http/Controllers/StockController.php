<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::all();
        $stock_water = Stock::all()->sum('ml_water');
        $stock_alcohol = Stock::all()->sum('ml_alcohol');
        //dd($stock_water, $stock_alcohol);

        return Inertia::render('Stock/Stock', [
            'stock' => $stock,
            'stock_water' => $stock_water,
            'stock_alcohol' => $stock_alcohol
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $stock = $request->name_fragrance;
        $stock_id = Stock::where('name_fragrance', 'like', '%'.$stock.'%')->value('id');
        //dd($stock_id);
        if($stock_id){
            $update = Stock::find($stock_id);
            $update->ml_water       = $request->ml_water + $update->ml_water ;
            $update->ml_alcohol     = $request->ml_alcohol + $update->ml_alcohol;
            $update->ml_fragrance   = $request->ml_fragrance + $update->ml_fragrance;
            $update->save();
        } else {
            Stock::create([
                'ml_water' => $request->ml_water,
                'ml_alcohol' => $request->ml_alcohol,
                'ml_fragrance' => $request->ml_fragrance,         
                'name_fragrance' => $request->name_fragrance,
            ]);
        }        
        return Redirect::route('stock.index');
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
