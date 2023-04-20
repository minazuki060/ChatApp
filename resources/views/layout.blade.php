<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>チャットアプリ</h1>
        </div>
        <div class="sidebar">
            @section('sidebar')
            <h2>グループ一覧</h2>
            <ul>
                @foreach($groups as $group)
                <li><a href="{{ route('home.index', ['groupId' => $group->id]) }}">{{ $group->name }}</a></li>
                @endforeach
            </ul>
            <a href="{{ route('group.create') }}">新しいグループを作成する</a>
            @show
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>