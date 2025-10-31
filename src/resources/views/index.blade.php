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
    <div class="todo-form">
        <div class="section-title">
            <h3>
                新規作成
            </h3>
        </div>
        <form action="/todos" method="post" class="create-form">
            @csrf
            <div class="create-form__item">
                <input type="text" name="content">
                <select name="category_id">
                    @foreach($items['categories'] as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">作成</button>
        </form>
    </div>
    <div class="todo-form">
        <div class="section__title">
            <h3>
                Todo検索
            </h3>
        </div>
        <form action="/todos/search" method="post" class="search-form">
            @csrf
            <div class="search-form__item">
                <input type="text" name="content">
                <select name="category_id">
                    @foreach($items['categories'] as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">検索</button>
        </form>
    </div>
    <div class="todo-list">
        <div class="todo-list__titles">
            <div class="todo-list__title">
                Todo
            </div>
            <div class="todo-list__title">
                カテゴリ
            </div>
        </div>
        @foreach($items['todos'] as $todo)
        <div class="todo-list__item">
            <form action="/todos/update" method="post" class="todo-list__update">
                @method('PATCH')
                @csrf
                <div class="todo-list__update-items">
                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                    <input type="text" name="content" value="{{ $todo['content'] }}">
                    <select name="category_id" value="$todo->category->getName()">
                        @foreach($items['categories'] as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
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