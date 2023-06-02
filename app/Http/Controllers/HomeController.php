<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\Group;
use \App\Models\User;
use \App\Models\Message;


class HomeController extends Controller
{

    //sideでトークルーム一覧を表示
    //home/groupidでトークルームを一覧表示し、グループのメッセージを一覧表示する
    public function index(Request $request, $groupId = null)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $groups = Group::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        // $groupIdがあれば、$groupを取得する
        if ($groupId) {
            $group = Group::findOrFail($groupId);
            $messages = $group->messages()->with('user')->orderBy('created_at', 'asc')->get();
        } else {
            $group = null;
            $messages = null;
        }
        //compact() 関数は、指定した変数名の値を配列として返すPHPの組み込み関数
        return view('home', compact('groups', 'group', 'messages'));
    }


    public function store(Request $request, $groupId = null)
    {
        //メッセージの保存処理を実装する
        $request->validate([
            'message' => 'required|max:140',
        ]);

        $message = new Message();
        $message->text = $request->input('message');
        $message->user_id = Auth::id();
        $message->group_id = $groupId;
        $message->save();

        return redirect()->back();
    }

}


