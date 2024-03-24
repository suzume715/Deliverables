<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
        <h1>棋譜投稿サイト</h1>
    </x-slot>
        <h1>投稿詳細</h1>
        <div class="edit"><a href="/records/{{ $record->id }}/edit">edit</a></div>
        <small>{{ $record->user->name }}</small>
        <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $record->id }})">delete</button> 
                </form>
        <div class='records'>
            <div class='record'>
                <h2 class='title'>
                    タイトル：{{ $record->title }}
                </h2>
                <p class='body'>先手：{{ $record->first_player_name }}</p>
                <p class='body'>後手：{{ $record->second_player_name }}</p>
                <p class='body'>先手の戦型：{{ $record->first_player_strategy }}</p>
                <p class='body'>後手の戦型：{{ $record->second_player_strategy }}</p>
                <p class='body'>先手の囲い：{{ $record->first_player_castle }}</p>
                <p class='body'>後手の囲い：{{ $record->second_player_castle }}</p>
                <p class='body'>備考：{{ $record->remark }}</p>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/kifu-for-js@5/bundle/kifu-for-js.min.js" charset="utf-8"></script>
            <script type="text/kifu">
                {{ $record->record }}
            </script>
        <div class="comment">
            @foreach($record->comments as $comment)  
                <p>{{ $comment->comment }}</p>
                @foreach($comment->replies as $reply)
                    <p>{{ $reply->reply }}</p>
                @endforeach
            @endforeach
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </x-app-layout>
</html>