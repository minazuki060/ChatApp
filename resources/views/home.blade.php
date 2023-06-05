<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="stylesheet" href="{{ asset('/css/home.css') }}" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <div class="pc">
    <head>
        <div class="pc-head">
            <h1>ChatApp</h1>
            <div class="pc-user-info">
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


    <main>
        <div class="pc-side">
            <h1>グループ一覧</h1>
            <ul>
                @if(isset($groups) && is_countable($groups) && count($groups) > 0)
                    @foreach($groups as $g)
                        <li><a href="{{ route('home.index', ['groupId' => $g->id]) }}">{{ $g->name }}</a></li>
                    @endforeach
                @else
                    <p>グループがありません。</p>
                @endif
            </ul>
            <div class="pc-new-group">
                <a href="{{ route('group.create') }}">新しいグループを作成する</a>
            </div>
        </div>

        <div class="pc-content">
            @if(isset($group))
                <!-- メッセージがある場合の処理 -->
                <h1>{{ $group->name }}</h1>
                @if(isset($messages) && is_countable($messages) && count($messages) > 0)
                    @foreach($messages as $message)
                    <div class="pc-message @if($message->user_id === Auth::id()) pc-right @else pc-left @endif">
                        <p>{{ $message->user->name }}: {{ $message->text }}</p>
                        </div>
                    @endforeach
                    <div class="pc-push"></div><!-- コンテンツ内に空の要素(.push)を加える -->
                @else
                    <p>メッセージはありません。</p>
                @endif
                <form method="POST" action="{{ route('home.store', $group->id) }}">
                    @csrf
                    <textarea name="message" placeholder="メッセージを入力してください"></textarea>
                    <button type="submit">送信</button>
                </form>
                @else
                <!-- グループが選択されていない場合はグループ一覧を表示 -->
                    <p>グループを選択してください。</p>
            @endif
        </div>
    </main>
 </div>

 <div class="sp">
    <head>
     <div class="sp-head">
        <h1>ChatApp</h1>
        <div class="sp-user-info">
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

    @if(Request::is('home'))
        <div class="sp-side">
        <h1>グループ一覧</h1>
            <ul>
                @if(isset($groups) && is_countable($groups) && count($groups) > 0)
                    @foreach($groups as $g)
                        <li><a href="{{ route('home.index', ['groupId' => $g->id]) }}">{{ $g->name }}</a></li>
                    @endforeach
                @else
                    <p>グループがありません。</p>
                @endif
            </ul>
            <div class="sp-new-group">
                <a href="{{ route('group.create') }}">新しいグループを作成する</a>
            </div>
        </div>
    @else
        <div class="sp-content">
        @if(isset($group))
            <!-- メッセージがある場合の処理 -->
            <h1><a href="{{ route('home.index') }}">＜戻る</a> {{ $group->name }}</h1>
            @if(isset($messages) && is_countable($messages) && count($messages) > 0)
                @foreach($messages as $message)
                    <div class="sp-message @if($message->user_id === Auth::id()) sp-right @else sp-left @endif">
                    <p>{{ $message->user->name }}: {{ $message->text }}</p>
                    </div>
                @endforeach
                <div class="sp-push"></div><!-- コンテンツ内に空の要素(.push)を加える -->
            @else
                <p>メッセージはありません。</p>
            @endif
            <form method="POST" action="{{ route('home.store', $group->id) }}">
                @csrf
                <textarea name="message" placeholder="メッセージを入力してください"></textarea>
                <button type="submit">送信</button>
            </form>
            @else
        @endif
        </div>
    @endif
</html>