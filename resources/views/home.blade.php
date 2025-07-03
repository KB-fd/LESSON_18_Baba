@extends('layouts.app')

@section('content')
<div class="container">
    <h1>投稿一覧</h1>

    {{-- フラッシュメッセージ --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 新規投稿ボタン --}}
    <div class="mb-3 text-end">
        <a href="{{ route('posts.create') }}" class="btn btn-primary">新規投稿</a>
    </div>

    {{-- 検索フォーム --}}
    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control" placeholder="投稿内容で検索" value="{{ old('keyword', $keyword ?? '') }}">
            <button type="submit" class="btn btn-outline-secondary">検索</button>
        </div>
    </form>

    {{-- 投稿一覧 --}}
    @if($posts->isEmpty())
        <p>投稿がまだありません。</p>
    @else
        <ul class="list-group">
            @foreach($posts as $post)
                <li class="list-group-item">
                    <strong>{{ $post->user->name }}</strong> さんの投稿<br>
                    <small>
                        投稿日: {{ $post->created_at->format('Y-m-d H:i') }}
                        @if($post->created_at != $post->updated_at)
                            / 更新: {{ $post->updated_at->format('Y-m-d H:i') }}
                        @endif
                    </small>
                    <p>{{ $post->content }}</p>

                    {{-- 自分の投稿だけ編集・削除を表示 --}}
                    @if(auth()->id() === $post->user_id)
                        <div class="d-flex gap-2">
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">編集</a>

                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">削除</button>
                            </form>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
