<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // ログイン必須
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 投稿一覧表示 + 検索機能
     */
    public function index(Request $request)
    {
        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // 投稿一覧を取得（ユーザー情報も取得）
        $posts = Post::with('user')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('content', 'like', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts', 'keyword'));
    }

    /**
     * 新規投稿画面の表示
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * 投稿を保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index')->with('success', '投稿が完了しました。');
    }

    /**
     * 投稿編集画面の表示
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403); // 自分以外の投稿は編集不可
        }

        return view('posts.edit', compact('post'));
    }

    /**
     * 投稿の更新
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index')->with('success', '投稿を更新しました。');
    }

    /**
     * 投稿の削除
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403); // 他人の投稿は削除不可
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', '投稿を削除しました。');
    }
}
