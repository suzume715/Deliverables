<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
    </head>
    <body>
        <h1>投稿詳細</h1>
        <div class="edit"><a href="/records/{{ $record->id }}/edit">edit</a></div>
        <small>{{ $record->user->name }}</small>
        <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $record->id }})">delete</button> 
                </form>
        <div class='record'>
            <h2 class='title'>
                タイトル：
                <a href="/records/{{ $record->id }}">{{ $record->title }}</a>
            </h2>
            <p class='players'>
                @if($record->first_player_name === null)
                    先手：匿名
                @else
                    先手：{{ $record->first_player_name }}
                @endif
                ‐
                @if($record->second_player_name === null)
                    後手：匿名
                @else
                    後手：{{ $record->second_player_name }}
                @endif
            </p>
            <p class='strategies'>
                @isset($record->first_player_strategy)
                    ▲{{ $record->first_player_strategy }}
                @endisset
                @isset($record->second_player_strategy)
                    △{{ $record->second_player_strategy }}
                @endisset
            </p>
            <p class='castles'></p>
                @isset($record->first_player_castle)
                    ▲{{ $record->first_player_castle }}
                @endisset
                @isset($record->second_player_castle)
                    △{{ $record->second_player_castle}}
                @endisset
            </p>
            @isset($record->remark)
                <p class='remark'>備考：{{ $record->remark }}</p>
            @endisset
            <p class='contributor'>投稿者：{{ $record->user->name }}</p>
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
    </body>
</html>