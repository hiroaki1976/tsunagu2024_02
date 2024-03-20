<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    /**
     * 一覧
     */
    public function index(Request $request)
    {
        $searchword = $request->searchword;
        // カテゴリ取得
        $category = new Category;
        $categories = $category->getLists();
    
        $category_id = $request->category_id;
        // scopeを利用した検索
        $posts = Post::with(['comments', 'category'])
            ->orderBy('created_at', 'desc')
            ->categoryAt($category_id)
            ->fuzzyNameMessage($searchword)	// ←★変更
            ->paginate(10);
    
        return view('bbs.index', [
            'posts' => $posts, 
            'categories' => $categories, 
            'category_id'=>$category_id,
            'searchword' => $searchword	
        ]);
    }

    public function show(Request $request, $id)
    {
    $post = Post::findOrFail($id);

    return view('bbs.show', [
        'post' => $post,
    ]);
    }

    /**
     * 投稿フォーム
     */
    public function create()
    {
        $category = new Category;
        $categories = $category->getLists()->prepend('選択', '');

        return view('bbs.create', ['categories' => $categories]);
    }
    
    /**
     * バリデーション、登録データの整形など
     */
    public function store(PostRequest $request)
    {
        $savedata = [
            'officename' => $request->officename,
            'subject' => $request->subject,
            'message' => $request->message,
            'category_id' => $request->category_id,
            // 現在認証されているユーザーのIDを取得して設定
            'user_id' => auth()->id(),
        ];
    
        $post = new Post;
        $post->fill($savedata)->save();
    
        return redirect('/bbs')->with('poststatus', '新規投稿しました');
    }

    /**
    * 編集画面
    */
    public function edit($post_id)
    {
        $category = new Category;
        $categories = $category->getLists();

        $post = Post::findOrFail($post_id);
        return view('bbs.edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * 編集実行
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->all())->save();

        return redirect('/bbs')->with('poststatus', '投稿を編集しました');
    }

    /**
     * 物理削除
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
    
        $post->comments()->delete(); // ←★コメント削除実行
        $post->delete();  // ←★投稿削除実行
    
        return redirect('/bbs')->with('poststatus', '投稿を削除しました');
    }
}
