<?php

namespace App\Http\Controllers;

use App\Events\TodoCompleted;
use App\Events\TodoCreated;
use App\Events\TodoDeleted;
use App\Events\TodoUpdated;
use App\Http\Requests\TodoRequest;
use App\Models\Todos;

class TodoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $todos = auth()->user()->todos;

        return view('todos.index')
            ->with('todos', $todos);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * @param TodoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TodoRequest $request)
    {
        $user = auth()->user();
        $todos = $user->todos()->create($request->input());

        event(new TodoCreated($todos));

        return redirect()->route('todos.index');
    }

    /**
     * @param Todos $todo
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Todos $todo)
    {
        if(auth()->id() != $todo->user_id)
        {
            abort(404);
        }

        return view('todos.show')
            ->with('todo', $todo);
    }

    /**
     * @param Todos $todos
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Todos $todo)
    {
        if(auth()->id() != $todo->user_id)
        {
            abort(404);
        }

        return view('todos.edit')
            ->with('todo', $todo);
    }

    /**
     * @param TodoRequest $request
     * @param Todos $todo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TodoRequest $request, Todos $todo)
    {
        if(auth()->id() != $todo->user_id)
        {
            abort(404);
        }

        $todo->fill($request->input())->update();

        event(new TodoUpdated($todo));

        return redirect()->route('todos.index');
    }

    /**
     * @param Todos $todo
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function destroy(Todos $todo)
    {
        if(auth()->id() != $todo->user_id)
        {
            abort(404);
        }

        $todo->forceDelete();

        event(new TodoDeleted($todo));

        return redirect()->route('todos.index');
    }

    /**
     * @param Todos $todo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($id)
    {
        $todo = Todos::find($id);

        if(auth()->id() != $todo->user_id)
        {
            abort(404);
        }

        $todo->update(['completed' => true]);

        event(new TodoCompleted($todo));

        return redirect()->route('todos.index');
    }
}
