<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TaskController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $task = Task::orderBy('id','desc')->get();
        return view('tasks.index')->with('storedTasks',$task);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'task_name'=>'required|min:5|max:255','regex:^[a-zA-Z]{2,40}\s*[a-zA-Z]{2,40}*$'

        ]);

        $task = new Task;

        $task->name = $request->task_name;

        $task->save();

        $request->session()->flash('succes', 'New Task has been added succesfully!');

        return redirect()->route('tasks.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::find($id);

        $task ->delete();

        session()->flash('succes','Task #'. $id . ' has been succesfully deleted !');

        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit')->with('task_edit',$task);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,
        [
            'update_name'=>'required','regex:^[a-zA-Z]{2,40}\s*[a-zA-Z]{2,40}*$'
        ]);

        $task = Task::find($id);

        $task->name = $request->update_name;

        $task->save();

        session()->flash('succes','Task #'. $id .' has been succesfully updated !');

        return redirect()->route('tasks.index');

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
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }


}
