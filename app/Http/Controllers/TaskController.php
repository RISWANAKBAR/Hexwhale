<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use App\Models\Category;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasksQuery = Task::query();

   
        if ($request->filled('priority')) {
            $tasksQuery->where('priority', $request->input('priority'));
        }

    
        if ($request->filled('due_date')) {
            $tasksQuery->where('due_date', $request->input('due_date'));
        }

   
        $sort = $request->input('sort');
        if ($sort) {
            $tasksQuery->orderBy($sort);
        }

        $tasks = $tasksQuery->get();

        return view('index', compact('tasks'));
    }
    public function getbyone()
    {
        $task = Task::find($id);

    if (!$task) {
        // Handle case where the task with the given ID was not found
        abort(404); // You can customize this based on your application's needs
    }

    return view('single_task', compact('task'));
    }

    public function create()
    {
        return view('create');
    }
 


   
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:High,Medium,Low',
            'category_name' => 'required|string', // Add validation for category_name
        ]);
    
        // Create or find the category based on the provided name
        $category = Category::firstOrCreate(['name' => $validatedData['category_name']]);
    
        // Create a task and associate it with the category
        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'],
            'priority' => $validatedData['priority'],
            'category_id' => $category->id, // Associate the task with the category
        ]);
    
        return redirect()->route('tasks.index')->with('message', 'Task created successfully!');
    }
    

    public function edit(Task $task)
    {
        return view('edit', compact('task'));
    }

  
    
    public function update(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:High,Medium,Low',
            'category_name' => 'required|string', // Add validation for category_name
        ]);
    
        // Create or find the category based on the provided name
        $category = Category::firstOrCreate(['name' => $validatedData['category_name']]);
    
        // Update the task details and associate it with the category
        $task->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'due_date' => $validatedData['due_date'],
            'priority' => $validatedData['priority'],
            'category_id' => $category->id, // Associate the task with the category
        ]);
    
        return redirect()->route('tasks.index')->with('message', 'Task updated successfully!');
    }
    

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully!');
    }

    public function markCompleted(Task $task)
    {
        $task->completed = true;
        $task->save();
    
        return redirect()->route('tasks.index')->with('message', 'Task marked as completed successfully!');
    }
}
