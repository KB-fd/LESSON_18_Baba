@extends('layouts.app')

@section('content')
<div class="container">
    <h1>投稿を編集する</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="content" class="form-label">内容</label>
            <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新する</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
