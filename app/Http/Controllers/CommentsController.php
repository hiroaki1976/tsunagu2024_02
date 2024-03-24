<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * バリデーション、登録データの整形など
     */
    public function store(CommentRequest $request)
    {
        // ログインユーザーのofficenameを取得
        $officename = Auth::user()->officename;

        $savedata = [
            'post_id' => $request->post_id,
            'name' => $officename, // officenameをコメントの名前として設定
            'comment' => $request->comment,
        ];

        $comment = new Comment;
        $comment->fill($savedata)->save();

        return redirect()->route('bbs.show', [$savedata['post_id']])->with('commentstatus','コメントを投稿しました');
    }
}
