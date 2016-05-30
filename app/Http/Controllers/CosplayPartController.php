<?php

namespace App\Http\Controllers;

use App\Cosplay;
use App\CosplayPart;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class CosplayPartController extends Controller
{
    public function create(Request $request,$cosplayId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);
        if(Auth::user()->can('createPart', $cosplay)){
            return view('cosplay.part.create',compact('cosplay'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para crear partes');
            return redirect()->route('admin.cosplay.show',$cosplay);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$cosplay_id)
    {

        $cosplay = Cosplay::findOrFail($cosplay_id);

        if(Auth::user()->can('createPart', $cosplay)) {
            $this->validate($request, [
                'name' => 'required',
                'status' => 'in:' . CosplayPart::STATUS_PLANNED . "," . CosplayPart::STATUS_IN_PROGRESS . "," . CosplayPart::STATUS_FINISHED,
            ]);

            $part = new CosplayPart();
            $part->cosplay_id = $cosplay->id;
            $part->name = $request->input('name');
            $part->progress = $request->input('progress');
            $part->description = $request->input('description');
            $part->status = $request->input('status');
            $part->save();

            $request->session()->flash('message', 'La parte fue creada correctamente');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para crear la parte');
        }

        return redirect()->route('admin.cosplay.show', $cosplay);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$cosplayId,$partId)
    {
        $part = CosplayPart::findOrFail($partId);
                
        if(Auth::user()->can('edit', $part)) {
            return view('cosplay.part.edit',compact('part'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para editar la parte');
            return redirect()->route('admin.cosplay.show', $cosplayId);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cosplayId, $partId)
    {
        $part = CosplayPart::findOrFail($partId);
        if(Auth::user()->can('edit', $part)) {
            $part->name = $request->input('name');
            $part->progress = $request->input('progress');
            $part->description = $request->input('description');
            $part->status = $request->input('status');
            $part->save();
            $request->session()->flash('message', 'La parte fue modificada correctamente');
            return redirect()->route('admin.cosplay.show', $part->cosplay);
        }else{
            $request->session()->flash('errors', 'No tiene permisos para editar la parte');
            return redirect()->route('admin.cosplay.show', $cosplayId);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cosplayId,$partId)
    {
        $part = CosplayPart::findOrFail($partId);

        if(Auth::user()->can('delete', $part)){
            $part->delete();
            $request->session()->flash('message', 'La parte fue borrada correctamente.');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para borrar la parte');
        }

        return redirect()->route('admin.cosplay.show',$part->cosplay);
    }
}
