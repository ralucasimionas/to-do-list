<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecurrentTaskRequest;
use App\Models\RecurringTasks;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecurringTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $recurringTaskLists = RecurringTasks::where("user_id", $id)
            ->where("status", "active")
            ->orderBy("updated_at", "DESC")
            ->get();
        return view("recurringTaskList.index", compact("recurringTaskLists"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $user = Auth::user();
        $taskId = $request->id;
        $task = Task::findOrFail($taskId);

        return view("recurringTaskList.create", compact("task"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $taskId = intval($request->task_id);
        $taskList = RecurringTasks::find($taskId);

        $existingTaskList = DB::table("users_recurring_tasks")
            ->where("user_id", $userId)
            ->where("task_id", $taskId)
            ->where("status", "active")
            ->first();

        $currentTaskList = DB::table("users_tasks")
            ->where("user_id", $userId)
            ->where("task_id", $taskId)
            ->first();

        if ($currentTaskList) {
            return redirect()
                ->route("tasks.list")
                ->with(
                    "success",
                    "Your task already exists in the current tasks list!"
                );
        } elseif ($existingTaskList) {
            return redirect()
                ->route("tasks.list")
                ->with("success", "The same recurring task already exists!");
        } else {
            $taskList = new RecurringTasks();
            $taskList->user_id = $userId;
            $taskList->task_id = $taskId;
            $taskList->recurrence = $request->recurrence;
            $taskList->start_date = $request->start_date;
            $taskList->finish_date = $request->finish_date;

            $taskList->save();
        }

        return redirect()
            ->route("tasks.list")
            ->with(
                "success",
                "Your task has been successfully made recurring!"
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $userId = Auth::user()->id;
        $recurringTask = RecurringTasks::findOrFail($id);

        return view("recurringTaskList.show", compact("recurringTask"));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRecurrentTaskRequest $request, string $id)
    {
        $task = RecurringTasks::findOrFail($id);
        $task->update($request->validated());
        return redirect()
            ->route("recurringtasklists.index", $task->id)
            ->with(
                "success",
                "Your recurring task has been successfully updated!"
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $taskList = RecurringTasks::findOrFail($id);
        $taskList->delete();
        return redirect()
            ->route("recurringtasklists.index")
            ->with(
                "success",
                "Your recurrent task has been successfully deleted!"
            );
    }
}
