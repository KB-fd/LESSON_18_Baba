@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新規投稿</h1>

    {{-- バリデーションエラー表示 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 投稿フォーム --}}
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">投稿内容</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
