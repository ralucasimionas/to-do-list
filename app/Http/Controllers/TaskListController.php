<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $taskLists = TaskList::where("user_id", $id)
            ->orderBy("updated_at", "DESC")
            ->get();
        return view("tasklist.index", compact("taskLists"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $user = Auth::user();
        $taskId = $request->id;
        $task = Task::findOrFail($taskId);

        return view("taskList.create", compact("task"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $taskId = intval($request->task_id);
        $taskList = TaskList::find($taskId);

        if (!$taskList) {
            $taskList = new TaskList();
            $taskList->user_id = $userId;
            $taskList->task_id = $taskId;
            $taskList->deadline = $request->deadline;

            $taskList->save();
        }

        return redirect()
            ->route("tasks.list")
            ->with(
                "success",
                "Your task has been successfully added to your list!"
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        $tasks = Task::where("user_id", $userId)->first();

        return view("taskList.show", compact("task"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
