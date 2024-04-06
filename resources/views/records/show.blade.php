<x-app-layout>
    <x-slot name="header">
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
        <h1>投稿詳細</h1>
    </x-slot>
    
        <div id="title_menu" onmouseover="show(this)" onmouseleave="hide(this)" style="position:absolute; background-color: white; display: none; right: 0;" class="mr-3">
            @can('edit', $record)
                <a href="/records/{{ $record->id }}/edit" style="display: block;" class="pt-2 px-3 pb-1">
                    投稿を編集する
                </a>
            @endcan
            @can('delete', $record)
                <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $record->id }})" class="pt-1 px-3 pb-2">
                        投稿を削除する
                    </button>
                </form>
            @endcan
        </div>
    
        <h2 id="title" onmouseover="show(title_menu)" onmouseleave="hide(title_menu)" class="pl-3 pt-3 text-3xl border-2">
            {{ $record->title }}
        </h2>
        
        <p class="pl-3 text-sm border-2">
            投稿者：{{ $record->user->name }}
        </p>
        
        <p class="text-2xl pl-3 py-1 border-2">
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
    
        <p class="pl-7 py-1 border-2">
            @isset($record->first_player_strategy)
                ▲{{ $record->first_player_strategy }}
            @endisset
            @isset($record->second_player_strategy)
                △{{ $record->second_player_strategy }}
            @endisset
            @isset($record->first_player_castle)
                ▲{{ $record->first_player_castle }}
            @endisset
            @isset($record->second_player_castle)
                △{{ $record->second_player_castle}}
            @endisset
        </p>
        
        
        @isset($record->remark)
            <p class="pl-7 py-1 border-2">
                備考：{{ $record->remark }}
            </p>
        @endisset
            
        <script src="https://cdn.jsdelivr.net/npm/kifu-for-js@5/bundle/kifu-for-js.min.js" charset="utf-8"></script>
            <div class="ml-14 my-1 border-2">
                <script type="text/kifu">
                    {{ $record->record }}
                </script>
            </div>
            
        <div class="m-1 border-2 border-blue-400">
            @foreach($record->comments as $comment)
                <div id="comment_menu_{{ $comment->id }}" onmouseover="show(this)" onmouseleave="hide(this)" style="position:absolute; background-color: white; display: none; right: 0;" class="mr-3">
                    <div class="flex">
                        <button onclick="Reply({{ $comment->id }})" class="px-3 py-1">
                            返信する
                        </button>
                        @can('update', $comment)
                            <button onclick="edit_comment({{ $comment->id }})" class="px-3 py-1">
                                編集する
                            </button>
                        @endcan
                        @can('delete', $comment)
                            <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteComment({{ $comment->id }})" class="px-3 py-1">
                                    削除する
                                </button> 
                            </form>
                        @endcan
                    </div>
                </div>
            
                <div id="view_comment_{{ $comment->id }}" style="display: block;" onmouseover="show(comment_menu_{{ $comment->id }})" onmouseleave="hide(comment_menu_{{ $comment->id }})" class="pl-3">
                    <p class="text-blue-500 text-sm">{{ $comment->user->name }}</p>
                    <p>{{ $comment->comment }}</p>
                </div>
                
                <div id="edit_comment_{{ $comment->id }}" style="display: none;" class="px-3">
                    <form action="/comments/{{ $comment->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
                        <textarea type="text" name="comment[comment]" class="w-full">{{ old('comment.comment', $comment->comment) }}</textarea><br>
                        <p class="comment__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
                        <input type="submit" value="保存"/ class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1">
                        <button type="button" onclick="cancel_edit_comment({{ $comment->id }})" class="px-3 py-1">
                            キャンセル
                        </button>
                    </form>
                </div>
                
                @foreach($comment->replies as $reply)
                    <div id="reply_menu_{{ $reply->id }}" onmouseover="show(this)" onmouseleave="hide(this)" style="position:absolute; background-color: white; display: none; right: 0;" class="mr-3">
                        <div class="flex">
                            @can('update', $reply)
                                <button type="button" onclick="editReply({{ $reply->id }})" class="px-3 py-1">
                                    編集する
                                </button>
                            @endcan
                            @can('delete', $reply)
                                <form action="/replies/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteReply({{ $reply->id }})" class="px-3 py-1">
                                        削除する
                                    </button> 
                                </form>
                            @endcan
                        </div>
                    </div>
                    
                    <div id="view_reply_{{ $reply->id }}" style="display: block;" onmouseover="show(reply_menu_{{ $reply->id }})" onmouseleave="hide(reply_menu_{{ $reply->id }})" class="w-full pl-3">
                        <p class="text-blue-500 pl-6 text-sm">{{ $reply->user->name }}</p>
                        <p class="pl-6">{!!nl2br(e($reply->reply))!!}</p>
                    </div>
                        
                    <div id="edit_reply_{{ $reply->id }}" style="display: none;" class="w-full pl-6 pr-3">
                        <form action="/replies/{{ $reply->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type='hidden' name='reply[comment_id]' value="{{ $comment->id }}">
                            <textarea type="text" name="reply[reply]" class="w-full">{{ old('reply.reply', $reply->reply) }}</textarea><br>
                            <p class="reply__error" style="color:red">{{ $errors->first('reply.reply') }}</p>
                            <input type="submit" value="保存"/ class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1">
                            <button type="button" onclick="cancel_edit_reply({{ $reply->id }})" class="px-3 py-1">
                                キャンセル
                            </button>
                        </form>
                    </div>
                @endforeach
                
                
                <div id="reply_{{ $comment->id }}" style="display: none;" class="w-full pl-9 py-3 pr-3">
                    <form action="/replies" method="POST">
                        @csrf
                        <input type='hidden' name='reply[comment_id]' value="{{ $comment->id }}">
                        <textarea name="reply[reply]" placeholder="ここに返信を入力" class="w-full"></textarea>
                        <p class="reply__error" style="color:red">{{ $errors->first('reply.reply') }}</p>
                        <input type="submit" value="保存" class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1"/>
                        <button type="button" onclick="cancel_reply({{ $comment->id }})" class="px-3 py-1">
                            キャンセル
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
        
        <div class="w-full p-3 border-2">
            <form action="/comments" method="POST">
                @csrf
                <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
                <textarea name="comment[comment]" placeholder="ここにコメントを入力" class="w-full"></textarea>
                <p class="comment__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
                <div class="flex justify-end">
                    <input type="submit" value="送信" class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1"/>
                </div>
            </form>
        </div>
        
        <div class="flex">
            <div class="m-3">
                <a href="/" class="px-2 py-1 bg-blue-400 text-white font-semibold rounded hover:bg-blue-500">戻る</a>
            </div>
        </div>
        
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('投稿は削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            
            function deleteComment(id) {
                'use strict'
        
                if (confirm('コメントは削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            
            function deleteReply(id) {
                'use strict'
        
                if (confirm('返信は削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
            
            function edit_comment(id){
                'use strict'
                document.getElementById(`view_comment_${id}`).style.display = "none";
                document.getElementById(`edit_comment_${id}`).style.display = "block";
                document.getElementById(`comment_menu_${id}`).style.display = "none";
            }
            
            function cancel_edit_comment(id){
                'use strict'
                document.getElementById(`view_comment_${id}`).style.display = "block";
                document.getElementById(`edit_comment_${id}`).style.display = "none";
            }
            
            function cancel_reply(id){
                'use strict'
                document.getElementById(`reply_${id}`).style.display = "none";
            }
            
            function Reply(id){
                'use strict'
                document.getElementById(`reply_${id}`).style.display = "block";
                document.getElementById(`comment_menu_${id}`).style.display = "none";
            }
            
            function editReply(id){
                'use strict'
                document.getElementById(`view_reply_${id}`).style.display = "none";
                document.getElementById(`edit_reply_${id}`).style.display = "block";
                document.getElementById(`reply_menu_${id}`).style.display = "none";
            }
            
            function cancel_edit_reply(id){
                'use strict'
                document.getElementById(`view_reply_${id}`).style.display = "block";
                document.getElementById(`edit_reply_${id}`).style.display = "none";
            }
            
            function show(x) {
                x.style.display = "block";
            }
        
            function hide(x) {
                x.style.display = "none";
            }
        </script>
</x-app-layout>