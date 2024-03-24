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
        <div class='delete'>
            <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $record->id }})">delete</button> 
            </form>
        </div>
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
                <div class="comment_{{ $comment->id }}" style="display: block">
                    <p class="comment_{{ $comment->id }}">{{ $comment->comment }}</p>
                    <button type="button" onclick="editComment({{ $comment->id }})" >編集</button>
                </div>
                <div class="comment_{{ $comment->id }}" style="display: none">
                    <form action="/comments/{{ $comment->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
                        <textarea type="text" name="comment[comment]">{{ old('comment.comment', $comment->comment) }}</textarea><br>
                        <p class="comment__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
                        <input type="submit" value="保存"/>
                    </form>
                    <button type="button" onclick="editComment({{ $comment->id }})" >戻る</button>
                </div>
                <small>{{ $comment->user->name }}</small>
                <div class='delete'>
                    <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                    </form>
                </div>
                @foreach($comment->replies as $reply)
                    <p>{{ $reply->reply }}</p>
                @endforeach
            @endforeach
        </div>
        <div class='make_comment'>
            <form action="/comments" method="POST">
                @csrf
                <h2>コメントする</h2>
                <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
                <textarea name="comment[comment]" placeholder="ここにコメントを入力"></textarea>
                <input type="submit" value="store_comment"/>
            </form>
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
            
            function deleteComment(id) {
                'use strict'
        
                if (confirm('コメントは削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }

            function editComment(id){
                'use strict'
                
                var elements = document.getElementsByClassName(`comment_${id}`);
                for (const element of elements) {
                    if(element.style.display === "none"){
                        element.style.display = "block";
                    }else{
                        element.style.display = "none";
                    }
                }
            }
        </script>
    </body>
</html>