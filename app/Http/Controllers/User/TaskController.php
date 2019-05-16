<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use Auth;
use DB;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        return view('task.user.all', compact('tasks'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        DB::table('tasks')->where('id', $id)->update(['status'=> 2]);

    }

    public function destroy($id)
    {
        //
    }
    public function userupdate(Request $request)
    {
        $id = $request->id;
        DB::table('tasks')->where('id', $id)->update(['status'=> 2]);

    }
}
