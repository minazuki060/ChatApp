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
    public function showRoomList()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $groups = Group::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        $groups = $groups ?? []; // nullの場合は空の配列にする

        return view('home', compact('groups'));
    }


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
        } else {
            $group = null;
        }
        return view('home')->with('groups', $groups)->with('group', $group);
    }


    public function store(Request $request, Group $group)
    {
        //メッセージの保存処理を実装する
        $request->validate([
            'message' => 'required|max:140',
        ]);

        $message = new Message();
        $message->message = $request->input('message');
        $message->user_id = Auth::id();
        $message->group_id = $group->id;
        $message->save();

        return redirect()->back();
    }

}


