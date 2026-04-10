<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        return Inertia::render('Todos/Index', [
            'todos' => Auth::user()->todos()->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $request->user()->todos()->create($validated);

        return redirect()->back();
    }

    public function update(Request $request, Todo $todo)
    {
        abort_if($request->user()->id !== $todo->user_id, 403);

        // Simple toggle for is_completed
        if ($request->has('is_completed')) {
            $todo->update([
                'is_completed' => $request->boolean('is_completed')
            ]);
        } else {
             $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
            $todo->update($validated);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, Todo $todo)
    {
        abort_if($request->user()->id !== $todo->user_id, 403);

        $todo->delete();

        return redirect()->back();
    }
}
