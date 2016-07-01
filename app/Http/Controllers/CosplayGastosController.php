<?php

namespace App\Http\Controllers;

use App\Cosplay;
use App\Gasto;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CosplayGastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Cosplay $cosplay)
    {
        if(Auth::user()->can('createCost', $cosplay)){
            return view('cosplay.gastos.create',compact('cosplay'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para crear gastos');
            return redirect()->route('admin.cosplay.showtab',[$cosplay,'gastos']);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $cosplayId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);

        $this->validate($request, [
            'name' => 'required',
            'cost' => 'required|numeric|min:0',
        ]);

        $gasto = new Gasto();
        $gasto->name = $request->input('name');
        $gasto->cost = $request->input('cost');
        $gasto->cosplay_id = $cosplay->id;
        $gasto->save();

        $request->session()->flash('message', 'El gasto fue creado correctamente.');

        return redirect()->route('admin.cosplay.showtab',[$cosplay,'gastos']);

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
    public function edit(Request $request,$cosplayId,$costId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);
        $cost = Gasto::findOrFail($costId);

        if(Auth::user()->can('edit', $cost)){
            return view('cosplay.gastos.edit',compact('cosplay','cost'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para editar el gasto');
            return redirect()->route('admin.cosplay.showtab', [$cosplayId,'gastos']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$cosplayId, $costId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);
        $cost = Gasto::findOrFail($costId);

        $cost->name = $request->input('name');
        $cost->cost = $request->input('cost');
        $cost->save();

        $request->session()->flash('message', 'El gasto fue modificado correctamente.');
        return redirect()->route('admin.cosplay.showtab', [$cosplayId,'gastos']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$cosplayId,$costId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);
        $cost = Gasto::findOrFail($costId);

        if(Auth::user()->can('delete', $cost)){
            $cost->delete();
            $request->session()->flash('message', 'El gasto fue borrado correctamente.');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para borrar el gasto');
        }

        return redirect()->route('admin.cosplay.showtab',[$cost->cosplay,'gastos']);

    }
}
