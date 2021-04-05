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
        $perfumes = Perfume::orderBy('id', 'desc')->paginate(12);
        $stock = Stock::all();

        $stock_water = Stock::all()->sum('ml_water');
        $stock_alcohol = Stock::all()->sum('ml_alcohol');

        return Inertia::render('Dashboard', [
            'perfumes' => $perfumes,
            'stock' => $stock,
            'stock_water' => $stock_water,
            'stock_alcohol' => $stock_alcohol,
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
        $ml_perfume = $request->ml_water + $request->ml_alcohol + $request->ml_fragrance;
        $perfume = $request->name;
        $perfume_id = Perfume::where('name', 'like', '%'.$perfume.'%')->value('id');
        //dd($perfume_id, $request, $request->ml_water);
        if (isset($perfume_id)) {
            $update = Perfume::find($perfume_id);
            $update->ml_water       = $request->ml_water;
            $update->ml_alcohol     = $request->ml_alcohol;
            $update->ml_fragrance   = $request->ml_fragrance;
            $update->name_fragrance = $request->name_fragrance;
            
            $update->save();
        } else {
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
        }
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
        //dd($request->qtd);
        $perfume = Perfume::where('id', $request->perfume)->get();
        $perfume_id = Perfume::where('id', $request->perfume)->value('id');
        //dd($perfume_id);
        $stock_id = Stock::where('name_fragrance', $perfume[0]->name_fragrance)->value('id');
        $stock_ml_fragrance = Stock::find($stock_id)->value('ml_fragrance');
        $stock_water = Stock::all()->sum('ml_water');
        $stock_alcohol = Stock::all()->sum('ml_alcohol');
        $result_fragrance = $stock_ml_fragrance/$perfume[0]->ml_fragrance;
        $result_water = $stock_water/$perfume[0]->ml_water;
        $result_alcohol = $stock_alcohol/$perfume[0]->ml_alcohol;

        $array = [floor($result_alcohol), floor($result_fragrance), floor($result_water)];
        sort($array);
        if($array[0] > 0) {
            $update_perfume = Perfume::find($perfume_id);
            //$update_perfume->amount_created = $array[0] + $update_perfume->amount_created;
            $update_perfume->amount_created = $request->qtd + $update_perfume->amount_created;
            $update_perfume->save();

            return Redirect::route('dashboard');
        }
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

    public function reports()
    {
        $perfume = Perfume::all();
        $count = Perfume::all()->count();
        for ($i=0; $i < $count; $i++) { 
            $array[$perfume[$i]->name] =  $perfume[$i]->amount_created;
            $array_fragrance[$perfume[$i]->name_fragrance] =  $perfume[$i]->ml_fragrance * $perfume[$i]->amount_created;
        }
        arsort($array);  
        arsort($array_fragrance);  
        return Inertia::render('Reports', [
            'maisFabricado' => $array,
            'maisUtilizada' => $array_fragrance
        ]);
    }
}
