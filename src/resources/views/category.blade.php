@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
@if(session('message'))
<div class="message__success">
    {{ session('message') }}
</div>
@endif
@if($errors->any())
<ul class="alert__error">
    @foreach( $errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<div class="category-content">
    <form action="/categories" class="create-form" method="post">
        @csrf
        <div class="create-form__input">
            <input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="create-form__submit">
            <button type="submit">作成</button>
        </div>
    </form>
    <table class="category-table">
        <tr>
            <th>category</th>
        </tr>
        @foreach($categories as $category)
        <tr>
            <td class="update-form__td">
                <form action="/categories/update" class="update-form" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="update-form__input">
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                        <input type="text" value="{{ $category['name'] }}">
                    </div>
                    <div class="update-form__submit">
                        <button type="submit">更新</button>
                    </div>
                </form>
            </td>
            <td class="delete-form__td">
                <form action="/categories/delete" class="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                    <div class="delete-form__submit">
                        <button type="submit">削除</button>
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection