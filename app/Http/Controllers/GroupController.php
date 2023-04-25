<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Group;
use \App\Models\User;


class GroupController extends Controller
{   
    //トークルーム作成画面の作成
    public function create(Request $request)
    {
        
        //認証済みユーザーのidを取得
        $userId = Auth::id();

        // ユーザー一覧をページネートで取得
        $users = User::where('id', '<>', $userId)
                 ->paginate(20);

        // 検索フォームで入力された値を取得する
        $search = $request->input('search');

        // データベースからデータを取得
        $query = User::query();

        // もし検索フォームにキーワードが入力されたら
        if ($search) {

            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            
            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('name', 'like', '%'.$value.'%')
                    ->whereNotIn('id', [$userId]);
            }
            // 検索フォームにキーワードが入力されていない場合
        } else {
            // ユーザー一覧をページネートで取得し、認証済みユーザーは除外する
            $query->where('id', '<>', $userId);
        }
        
            // 上記で取得した$queryをページネートにし、変数$usersに代入
            $users = $query->paginate(20);

            // ビューにusersとsearchを変数として渡す
            return view('group/create')
                ->with([
                    'users' => $users,
                    'search' => $search,
                ]);
    }

    //トークルーム作成処理の実装
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:140',
        ]);

        $group = new Group();
        $group->name = $request->input('name');
        $group->save();

        $users = $request->input('users');
        $users[] = Auth::id(); // ログインしているユーザーのIDを追加
        $group->users()->attach($users);// 選択したユーザーをトークルームに参加させる

        return redirect()->route('home.index');

    }
}