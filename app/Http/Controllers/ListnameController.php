<?php

namespace App\Http\Controllers;

use App\Models\ItemListname;
use App\Models\Listname;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListnameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
         $listname = new Listname();
        $listname->name=$request->input('nombre');
        $listname->date=Carbon::now()->toDateString();
        $listname->save(); 
        $listnameid=$listname->id;
        //se agregan a la tabla de itemlistnames
        $data= $request->input('arreglo');
        $arreglo=json_decode($data,true);
        foreach($arreglo as $arreglito){

           $itemListnames= New ItemListname();
            $itemListnames->item_id=$arreglito['idProducto'];
            $itemListnames->listname_id=$listnameid;
            $itemListnames->pieces=$arreglito['cantidad'];
            $itemListnames->save();
            
        }
        return redirect()->route('items.index');
        
        //return $listname;
        
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
