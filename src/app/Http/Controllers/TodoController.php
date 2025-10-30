<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $categories = Category::all();
        $items = [
            'todos' => $todos,
            'categories' => $categories,
        ];
        return view('index', compact('items'));
    }

    public function store(TodoRequest $request)
    {
        $content = $request->only('category_id', 'content');
        Todo::create($content);
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $content = $request->only('content');
        Todo::find($request['id'])->update($content);
        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request['id'])->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }
}
