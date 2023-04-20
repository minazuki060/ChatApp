<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{ asset('/css/home.css') }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <div class="pc">
    <head>
        <div class="head">
         <h1>ChatApp</h1>
        </div> 
    </head>

   
    <main>
        <div class="side">
        <h1>グループ一覧</h1>
        <ul>
        @if(isset($groups) && is_countable($groups) && count($groups) > 0)
        @foreach($groups as $group)
            <li><a href="{{ route('home.index', ['groupId' => $group->id]) }}">{{ $group->name }}</a></li>
        @endforeach
    @else
        <p>グループがありません。</p>
    @endif
    <a href="{{ route('group.create') }}">新しいグループを作成する</a>
        </ul>
        </div> 


        <!-- トークルーム内でのメッセージ送信フォーム -->
        <div class="content">
        @if(isset($group) && is_countable($group->messages) && count($group->messages) > 0)
        <!-- メッセージがある場合の処理 -->
        <h1>{{ $group->name }}</h1>
        @if(count($group->messages) > 0)
            @foreach($group->messages as $message)
                <p>{{ $message->user->name }}: {{ $message->message }}</p>
            @endforeach
        @else
            <p>メッセージはありません。</p>
        @endif
        <form method="POST" action="{{ route('message.store', $group->id) }}">
            @csrf
            <input type="text" name="message" placeholder="メッセージを入力してください">
            <button type="submit">送信</button>
        </form>
    @else
        <p>グループを選択してください。</p>
    @endif
</div>

    </main>



 <div class="sp">
    <head>
     <div class="sp-head">
        <h1>ChatApp</h1>
     </div>
    </head>

     <div class="sp-content">
        <p></p>
     </div>
 </div>
</html>