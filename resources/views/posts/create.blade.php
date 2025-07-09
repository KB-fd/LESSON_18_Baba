@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新規投稿</h1>

    {{-- 投稿フォーム --}}
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="content" class="form-label">投稿内容</label>
            <textarea name="content" id="content" rows="5" class="form-control">{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">投稿する</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
