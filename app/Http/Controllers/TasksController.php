<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->where('status', 0)
                        ->orWhere('performer_id', Auth::user()->id)->where('status', 0)
                        ->orderBy('deadline')->paginate(5);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
            'deadline' => 'required'
        ]);
         Task::add($request->all());
        return redirect()->route('tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', compact('task'));
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
        $task = Task::find($id);
        $this->validate($request, [
            'title' => 'required',
            'deadline' => 'required',
        ]);
        $task->edit($request->all());
        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return redirect()->back();

    }

    public function toggle($id)
    {
        $task = Task::find($id);
        $task->makeComplete();

        return redirect()->back();
    }

    public function active()
    {
        $tasks = Auth::user()->tasks()->where('status', 0)->orderBy('deadline')->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function complete()
    {
        $tasks =  Task::where('user_id', Auth::user()->id)->where('status', 1)
                        ->orWhere('performer_id', Auth::user()->id)->where('status', 1)
                        ->paginate(5);

        return view('tasks.index', compact('tasks'));
    }

    public function external()
    {
        $tasks = Task::where('performer_id', Auth::user()->id)
                        ->where('status', 0)
                        ->orderBy('deadline')->paginate(5);

        return view('tasks.index', compact('tasks'));
    }

    public function sendForm()
    {
        return view('tasks.send');
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'performer' => 'required|email|exists:users,email',
            'title' => 'required|string'
        ]);
        $user = User::where('email', $request->get('performer'))->first();
        $task = Task::send($request->all());
        $task->performer_id = $user->id;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function removeCompleteTasks()
    {
        Task::where('user_id', Auth::user()->id)->where('status', 1)
            ->orWhere('performer_id', Auth::user()->id)->where('status', 1)
            ->delete();

        return redirect()->back()->with('status', 'Completed tasks deleted successfully ');
    }
}
