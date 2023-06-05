<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{ asset('/css/group.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <div class="head">
     <h1>ChatApp</h1>
        <div class="user-info">
            @auth
                <span>{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">ログアウト</button>
                </form>
            @endauth
        </div>
    </div> 
</head>

<body>
    <div class="title">
    <h1>トークルーム作成</h1>
    </div> 
    
    <div class="search">
    <form method="GET" action="{{ route('group.create') }}">
    <label for="search">ともだちを検索:</label>
    <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
    <button type="submit">検索</button>
    </form>
    </div>

    <div class="select">
    <form method="POST" action="{{ route('group.store') }}">
        @csrf
        <div class="form-group">
        <label for="users[]">ユーザーを選択:</label>
        </div>
        <div class="form-check">
        @foreach($users as $user)
                <input type="checkbox" id="user_{{ $user->id }}" name="users[]" value="{{ $user->id }}">
                <label for="user_{{ $user->id }}">{{ $user->name }}</label>
        @endforeach
        </div>
    </div>


        <div class="room-name">
            <label for="name">グループ名:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="button">
            <button type="submit" class="btn btn-primary">作成する</button>
        </div>
    </form>
</body>