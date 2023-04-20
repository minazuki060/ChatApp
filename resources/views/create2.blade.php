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
    <form method="POST" action="{{ route('group.store') }}">

        <div>
            <label for="name">トークルーム名</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="users">参加者</label>
            <select name="users[]" id="users" multiple required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">作成する</button>
    </form>