<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    public function store(TodoRequest $request)
    {
        $content = $request->only('content');
        Todo::create($content);
        return redirect('/')->with('message', 'Todoを作成しました');
    }
}
