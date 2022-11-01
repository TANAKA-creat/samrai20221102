<x-layout>
    <x-slot name="title">
       編集 - 業務報告
    </x-slot>

    <div class="back-link">
        &laquo; <a href="{{ route('posts.show',$post) }}">戻る</a>
    </div>
    <h1>編集 - 業務報告</h1>
    <form method="post" action="{{ route('posts.update', $post) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>
                記録日を編集します
                <input type="text" name="title" value="{{ old('title', $post->title) }}">
            </label>
            @error('title')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
               記録内容を編集します
                <textarea name="body">{{ old('body', $post->body) }}</textarea>
            </label>
            @error('body')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-button">
            <button>編集</button>
        </div>
    </form>
</x-layout>
