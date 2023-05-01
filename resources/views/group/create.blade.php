<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{ asset('/css/search.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <div class="head">
     <h1>ChatApp</h1>
    </div> 
</head>

<body>
    <h1>トークルーム作成</h1>
    
    <form method="GET" action="{{ route('group.create') }}">
    <label for="search">ともだちを検索:</label>
    <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
    <button type="submit">検索</button>
    </form>

    <form method="POST" action="{{ route('group.store') }}">
        @csrf
        <div class="form-group">
        <label for="users[]">Select Users:</label>
        @foreach($users as $user)
            <div class="form-check">
                <input type="checkbox" id="user_{{ $user->id }}" name="users[]" value="{{ $user->id }}">
                <label for="user_{{ $user->id }}">{{ $user->name }}</label>
            </div>
        @endforeach
        </div>

        <div class="form-group">
            <label for="name">Room Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">作成する</button>
    </form>
</body>