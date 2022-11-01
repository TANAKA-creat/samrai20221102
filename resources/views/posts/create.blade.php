<x-layout>
    <x-slot name="title">
        記録追記 - 業務報告
    </x-slot>

    <div class="back-link">
        &laquo; <a href="{{ route('posts.index') }}">戻る</a>
    </div>
    <h1>記録 - 業務報告</h1>
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>
                記録日を記入してください
                <input type="text" name="title" value="{{ old('title') }}">
            </label>
            @error('title')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
               日報を書いてください
                <textarea name="body">{{ old('body') }}</textarea>
            </label>
            @error('body')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <label>
            画像を貼り付けます
        </label>
        <input type="file" name="image">
        <div class="form-button">

            <button>登録</button>
        </div>
    </form>
</x-layout>
