<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\User;
use DataTables;
class TaskController extends Controller
{

    public function index()
    {
        $users = User::where('role_id', 2)->get();
        $tasks = Task::all();
        // return response($tasks);
        return view('task.admin.all', compact('tasks','users'));
    }

    public function create()
    {
        $users = User::where('role_id', 2)->get();
        return view('task.admin.new', compact('users'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'file' => 'required|mimes:jpeg,jpg,doc,cocx,pdf|max:500',
            'deadline' => 'required',
            'user_id' => 'required',
        ]);

        $file = $request->file('file');
        $slug = str_slug($request->title);
        if(isset($file)){
            $filename = $slug.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            $file->move('uploads', $filename);
        }

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->file = $filename;
        $task->deadline = $request->deadline;
        $task->user_id = $request->user_id;
        $task->status = 1;
        $task->save();
        return response(['message'=> 'Successfully Asigned task!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        // $task = Task::find($id);
        // unlink('uploads/'.$task->file);
        // $task->delete();
        // return back();
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $task = Task::find($id);
        unlink('uploads/'.$task->file);
        $task->delete();
        return response(['message'=> 'Successfully Deleted!']);
    }
    // public function alltask(){
    //     $tasks = Task::all();
    //     return DataTables::of($tasks)
    //             ->addColumn('action', function($tasks){
    //                return '<a onclick="up('.$tasks->id.')" class="btn btn-xs btn-primary"> <i class="fa fa-edit">  </i> </a>'.''.'<a onclick="del('.$tasks->id.')" class="btn btn-xs btn-danger"> <i class="fa fa-trash">  </i> </a>';
    //             })->make(true);
    // }
}
