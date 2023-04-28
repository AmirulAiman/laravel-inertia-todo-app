<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $todos = Auth::user()->todos()->orderBy('status','desc')->get();
            return Inertia::render('Dashboard', [
                'todos' => $todos
            ]);
        } else {
            return redirect(route('login'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Todo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        Auth::user()->todos()->create([
            'task' => $request->task,
            'detail' => $request->detail ?? '',
            'status' => $request->completed ? 'done' : 'new'
        ]);

        return redirect(route('todo.dashboard'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return Inertia::render('Todo/Edit',[
            'todo' => $todo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update([
            'task' => $request->task,
            'detail' => $request->detail ?? '',
            'due_date' => $request->due_date ?? NULL,
            'status' => $request->status
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }
}
