@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
@if(session('message'))
<div class="message__success">
    <ul>
        <li>{{ session('message') }}</li>
    </ul>
</div>
@endif
@if($errors->any())
<div class="message__error">
    @foreach($errors->all() as $error)
    <ul>
        <li>{{ $error }}</li>
    </ul>
    @endforeach
</div>
@endif
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
            <form action="/todos/update" method="post" class="todo-list__update">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" value="{{ $todo['id'] }}">
                <input type="text" name="content" value="{{ $todo['content'] }}">
                <button type="submit" class="todo-list__submit">更新</button>
            </form>
            <form action="/todos/delete" method="post">
                @method('DELETE')
                @csrf
                <input type="hidden" name="id" value="{{ $todo['id'] }}">
                <button type="submit" class="todo-list__submit todo-list__submit--delete">削除</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection