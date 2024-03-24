<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
    </head>
    <body>
        <h1>投稿一覧</h1>
        <div class='records'>
            @foreach($records as $record)
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
                <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $record->id }})">delete</button> 
                </form>
            @endforeach    
        </div>
        <div class='paginate'>
            {{ $records->links() }}
        </div>
        <div class='create'>
            <a href='records/create'>新規投稿</a>
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