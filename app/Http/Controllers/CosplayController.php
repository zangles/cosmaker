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
        ]);

        $cosplay = new Cosplay();
        $cosplay->name = $request->input('name');
        $cosplay->status = $request->input('status');
        $cosplay->description = $request->input('description');
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
