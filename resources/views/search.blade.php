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
    <div class="title">
     <p>ともだちを検索</p>
    </div> 

    <div class="search">
    <form method="GET" action="{{ route('search') }}">
    <input type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
    <button type="submit">検索</button>
    </form>
    </div>

    <div class="namelist">
    @foreach($users as $user)
    @if(!empty($search)) 
    <a href="{{ route('search', ['user_name' => $user->name]) }}">
        {{ $user->name }}
    </a>
    @endif
    @endforeach
    </div>
</body>