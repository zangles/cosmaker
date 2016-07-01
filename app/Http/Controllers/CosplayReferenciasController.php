<?php

namespace App\Http\Controllers;

use App\Cosplay;
use App\Referencias;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CosplayReferenciasController extends Controller
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
    public function create(Request $request,$cosplayId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);
        if(Auth::user()->can('createReference', $cosplay)){
            return view('cosplay.referencias.create',compact('cosplay'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para crear referencias');
            return redirect()->route('admin.cosplay.show',$cosplay);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$cosplayId)
    {
        $cosplay = Cosplay::findOrFail($cosplayId);

        foreach ($request->file('file') as $file) {
            $ref = new Referencias();
            $ref->cosplay_id = $cosplayId;
            $ref->file_ext = $file->getClientOriginalExtension();
            $ref->save();

            $img = Image::make($file->getRealPath());
            $img->fit(165, 94);
            $img->save(public_path().'/img/references/thumb_'.$ref->getFileName());

            $file->move(public_path().'/img/references',$ref->getFileName());
        };
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
    public function destroy(Request $request, $cosplayId,$refId)
    {
        $ref = Referencias::findOrFail($refId);

        if(Auth::user()->can('delete', $ref)){
            $ref->delete();
            unlink($ref->getRealFilePath());
            unlink($ref->getRealThumbPath());
            
            $request->session()->flash('message', 'La referencia fue borrada correctamente.');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para borrar la referencia');
        }

        return redirect()->route('admin.cosplay.showtab',[$ref->cosplay,'referencias']);
    }
}
