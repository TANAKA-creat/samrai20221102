<x-layout>
    <x-slot name="title">
        {{ $post->title }} - 業務報告
    </x-slot>

    <div class="back-link">
        &laquo; <a href="{{ route('posts.index') }}">戻る</a>
    </div>

    <h1>
        <span>{{ $post->title }}</span>
        <a href="{{ route('posts.edit', $post) }}">
            [編集]
        </a>

        <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
            @method('DELETE')
            @csrf
            <button class="btn">[削除]</button>
        </form>
    </h1>

    <p>{!! nl2br(e($post->body)) !!}</p>

    @foreach($posts as $post)
    <img src="{{ Storage::url($post->image) }}">
    @endforeach

    <h2>確認者返信</h2>
    <ul>
        <li>
            <form method="post" action="{{ route('comments.store', $post) }}" class="comment-form">
                @csrf
                <input type="text" name="body">
                <button>登録</button>
            </form>
        </li>
        @foreach ($post->comments()->latest()->get() as $comment)
            <li class="comment-font">
                {{ $comment->body }}
                <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                    @method('DELETE')
                    @csrf
                    <button class="btn">[削除]</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>記録者返信</h2>
    <ul>
        <li>
            <form method="post" action="{{ route('return_comments.store', $post) }}" class="comment-form">
                @csrf
                <input type="text" name="body">
                <button>登録</button>
            </form>
        </li>
        @foreach ($post->return_comments()->latest()->get() as $return_comment)
            <li class="comment-font">
                {{ $return_comment->body }}
                <form method="post" action="{{ route('return_comments.destroy', $return_comment) }}" class="delete-comment">
                    @method('DELETE')
                    @csrf
                    <button class="btn">[削除]</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
        'use strict'; {
            document.getElementById('delete_post').addEventListener('submit', e => {
                e.preventDefault();

                if (!confirm('本当に削除しますか??')) {
                    return;
                }

                e.target.submit();
            });

            document.querySelectorAll('.delete-comment').forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault();

                    if (!confirm('本当に削除しますか??')) {
                        return;
                    }
                    form.submit();
                });
            });

            document.querySelectorAll('.delete-return_comment').forEach(form => {
                form.addEventListener('submit', e => {
                    e.preventDefault();

                    if (!confirm('本当に削除しますか??')) {
                        return;
                    }
                    form.submit();
                });
            });
        }
    </script>
</x-layout>
