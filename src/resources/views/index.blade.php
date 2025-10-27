@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="message__success">
    Todoを作成しました
</div>
<div class="todo">
    <div class="todo-create">
        <form action="/todos" method="post" class="todo-create__form">
            @csrf
            <input type="text" name="content">
            <button type="submit">作成</button>
        </form>
    </div>
    <div class="todo-list">
        <div class="todo-list__title">
            Todo
        </div>
        @foreach($todos as $todo)
        <div class="todo-list__item">
            <form action="/todos/update" method="patch" class="todo-list__update">
                <input type="text" name="content" value="{{ $todo->content }}">
                <button type="submit" class="todo-list__submit">更新</button>
            </form>
            <form action="/todos/delete" method="delete">
                <button type="submit" class="todo-list__submit todo-list__submit--delete">削除</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection