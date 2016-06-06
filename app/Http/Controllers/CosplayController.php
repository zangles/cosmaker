<?php

namespace App\Http\Controllers;

use App\Cosplay;
use App\Http\Requests\CosplayStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CosplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cosplays = Auth::User()->cosplays()->get();
        
        return view('cosplay.index',compact('cosplays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cosplay.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CosplayStoreRequest $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'status' => 'in:'.Cosplay::PLANNED.",".Cosplay::IN_PROGRESS.",".Cosplay::FINISHED,
            'budget' => 'numeric',
        ]);

        $cosplay = new Cosplay();
        $cosplay->name = $request->input('name');
        $cosplay->status = $request->input('status');
        $cosplay->description = $request->input('description');
        $cosplay->budget = $request->input('budget');
        $cosplay->owner = Auth::User()->id;
        $cosplay->save();

        $cosplay->users()->sync([Auth::User()->id]);

        $request->session()->flash('message', 'El cosplay fue creado correctamente.');

        return redirect()->route('admin.cosplay.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id,$tab = 'partes')
    {
        $cosplay = Cosplay::findOrFail($id);

        if(Auth::user()->can('viewDetaills', $cosplay)){
            return view('cosplay.show',compact(['cosplay','tab']));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para ver el cosplay');
            return redirect()->route('admin.cosplay.index');
        }

    }


    public function showtab(Request $request,$cosplayId,$tab)
    {
        return $this->show($request,$cosplayId,$tab);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cosplay = Cosplay::findOrFail($id);
        return view('cosplay.edit',compact('cosplay'));
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

        $cosplay = Cosplay::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'status' => 'in:'.Cosplay::PLANNED.",".Cosplay::IN_PROGRESS.",".Cosplay::FINISHED,
            'budget' => 'numeric',
        ]);

        $cosplay->name = $request->input('name');
        $cosplay->status = $request->input('status');
        $cosplay->description = $request->input('description');
        $cosplay->budget = $request->input('budget');
        $cosplay->save();

        return redirect()->route('admin.cosplay.show',$cosplay);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cosplay = Cosplay::findOrFail($id);
        if(Auth::user()->can('delete', $cosplay)){
            $cosplay->delete();
            $request->session()->flash('message', 'El cosplay fue borrado correctamente.');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para borrar el cosplay');
        }

        return redirect()->route('admin.cosplay.index');
    }
}
