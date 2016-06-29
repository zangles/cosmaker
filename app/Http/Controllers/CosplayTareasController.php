<?php

namespace App\Http\Controllers;

use App\Cosplay;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CosplayTareasController extends Controller
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
        if(Auth::user()->can('createTask', $cosplay)){
            return view('cosplay.tareas.create',compact('cosplay'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para crear tareas');
            return redirect()->route('admin.cosplay.showtab',[$cosplay,'tareas']);
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
        ]);

        $tarea = new Task();
        $tarea->name = $request->input('name');
        $tarea->status = Task::STATUS_INCOMPLETED;
        $tarea->cosplay_id = $cosplay->id;
        $tarea->save();

        $request->session()->flash('message', 'La tarea fue creada correctamente.');

        return redirect()->route('admin.cosplay.showtab',[$cosplay,'tareas']);
    }

    public function changeStatus(Request $request,$task,$status)
    {
        $task = Task::findOrFail($task);

        $task->status = $status;
        $task->save();

        return response()->json([
            'status' => true
        ]);
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
    public function edit(Request $request,$cosplayId,$id)
    {
        
        $task = Task::findOrFail($id);
        $cosplay = $task->cosplay;
        if(Auth::user()->can('edit', $task)){
            return view('cosplay.tareas.edit',compact('cosplay','task'));
        }else{
            $request->session()->flash('errors', 'No tiene permisos para crear tareas');
            return redirect()->route('admin.cosplay.showtab',[$task->cosplay,'tareas']);
        }
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$cosplayId, $task)
    {
        $task = Task::findOrFail($task);

        $this->validate($request, [
            'name' => 'required',
        ]);
        
        if(Auth::user()->can('edit', $task)) {
            $task->name = $request->input('name');
            $task->save();
            $request->session()->flash('message', 'La tarea fue modificada correctamente');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para editar la tarea');
        }
        
        return redirect()->route('admin.cosplay.showtab',[$task->cosplay,'tareas']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        if(Auth::user()->can('delete', $task)){
            $task->delete();
            $request->session()->flash('message', 'La tarea fue borrada correctamente.');
        }else{
            $request->session()->flash('errors', 'No tiene permisos para borrar la tarea');
        }

        return redirect()->route('admin.cosplay.showtab',[$task->cosplay,'tareas']);
    }
}
