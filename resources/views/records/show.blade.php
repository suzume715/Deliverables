<x-app-layout>
    <x-slot name="header">
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
        <h1>投稿詳細</h1>
    </x-slot>
        
        <div class="flex justify-between">
            <div class="pl-3 pt-3">
                <p class="text-sm">
                    投稿者：{{ $record->user->name }}
                </p>
            </div>
            
            <div id="menu">
                <div style="margin: 5px; width: 20px; height: 2px; background-color: black;"></div>
                <div style="margin: 5px; width: 20px; height: 2px; background-color: black;"></div>
                <div style="margin: 5px; width: 20px; height: 2px; background-color: black;"></div>
            </div>
            
            <div id="list" style="position:absolute; background-color: white; display: none; right: 0;">
                <div id="close" style="left: 100%; transform: translateX(-100%);" class="relative w-7 h-7 border-2
                before:content-[''] before:absolute before:w-1 before:h-7 before:bg-black before:top-1/2 before:left-1/2 before:-translate-x-1/2 before:-translate-y-1/2 before:rotate-45
                after:content-[''] after:absolute after:w-1 after:h-7 after:bg-black after:top-1/2 after:left-1/2 after:-translate-x-1/2 after:-translate-y-1/2 after:-rotate-45"></div>
                @can('edit', $record)
                    <a href="/records/{{ $record->id }}/edit" class="p-3">
                        投稿を編集する
                    </a>
                @endcan
                @can('delete', $record)
                    <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $record->id }})" class="p-3">
                            投稿を削除する
                        </button>
                    </form>
                @endcan
            </div>
        </div>
        
        <script>
            let menu = document.getElementById("menu");
            let list = document.getElementById("list");
 
            menu.addEventListener('click', function () {
                menu.style.display = "none";
                list.style.display = "block";
            });
            
            let close = document.getElementById("close");
            close.addEventListener('click', function () {
                menu.style.display = "block";
                list.style.display = "none";
            });
        </script>
        
        <h2 class="pl-3 pt-3 text-3xl">
            {{ $record->title }}
        </h2>
        
        <p class="text-2xl pl-3 my-1">
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
    
        <p class="pl-7 py-1">
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
            <p class="pl-7 py-1">
                備考：{{ $record->remark }}
            </p>
        @endisset
            
        <script src="https://cdn.jsdelivr.net/npm/kifu-for-js@5/bundle/kifu-for-js.min.js" charset="utf-8"></script>
            <div class="ml-14 my-1">
                <script type="text/kifu">
                    {{ $record->record }}
                </script>
            </div>
            
        <div class="m-1 border-2 border-blue-400">
            @foreach($record->comments as $comment)
                <div class="flex">
                    <div id="view_comment_{{ $comment->id }}" style="display: block;" class="w-full pl-3">
                        <p class="text-blue-500 text-sm">{{ $comment->user->name }}</p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                    <div id="edit_comment_{{ $comment->id }}" style="display: none;" class="w-full pl-3">
                        <form action="/comments/{{ $comment->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
                            <textarea type="text" name="comment[comment]" class="w-full">{{ old('comment.comment', $comment->comment) }}</textarea><br>
                            <p class="comment__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
                            <div class="flex justify-end">
                                <input type="submit" value="保存"/ class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1">
                            </div>
                        </form>
                    </div>
                    
                    <div class="w-24 pt-2 flex justify-center">
                        <button id="reply_button_{{ $comment->id }}" type="button" onclick="Reply({{ $comment->id }})" class="h-8 px-2 py-1 text-yellow-500 border border-yellow-500 font-semibold rounded hover:bg-yellow-100">
                            返信
                        </button>
                    </div>
                    
                    @can('update', $comment)
                        <div class="w-24 pt-2 flex justify-center">
                            <button id="comment_mode_button_{{ $comment->id }}" type="button" onclick="Comment_mode({{ $comment->id }})" class="h-8 px-2 py-1 text-blue-500 border border-blue-500 font-semibold rounded hover:bg-blue-100">
                                編集
                            </button>
                        </div>
                    @endcan
                    
                    @can('delete', $comment)
                        <div class="w-24 pt-2 flex justify-center">
                            <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteComment({{ $comment->id }})" class="h-8 px-2 py-1 text-red-500 border border-red-500 font-semibold rounded hover:bg-red-100">
                                    削除
                                </button> 
                            </form>
                        </div>
                    @endcan
                </div>
                
                @foreach($comment->replies as $reply)
                    <div class="flex">
                        <div id="view_reply_{{ $reply->id }}" style="display: block;" class="w-full pl-3">
                            <p class="text-blue-500 pl-6 text-sm">{{ $reply->user->name }}</p>
                            <p class="pl-6">{{ $reply->reply }}</p>
                        </div>
                        
                        <div id="edit_reply_{{ $reply->id }}" style="display: none;" class="w-full pl-3">
                            <form action="/replies/{{ $reply->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type='hidden' name='reply[comment_id]' value="{{ $comment->id }}">
                                <textarea type="text" name="reply[reply]" class="w-full ml-6">{{ old('reply.reply', $reply->reply) }}</textarea><br>
                                <p class="reply__error" style="color:red">{{ $errors->first('reply.reply') }}</p>
                                <div class="flex justify-end">
                                    <input type="submit" value="保存"/ class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1">
                                </div>
                            </form>
                        </div>
                        
                        <div class="w-24 pt-2 flex justify-center">
                        </div>
                        
                        @can('update', $reply)
                            <div class="w-24 pt-2 flex justify-center">
                                <button id="reply_mode_button_{{ $reply->id }}" type="button" onclick="Reply_mode({{ $reply->id }})" class="h-8 px-2 py-1 text-blue-500 border border-blue-500 font-semibold rounded hover:bg-blue-100">
                                    編集
                                </button>
                            </div
                        @endcan
                        @can('delete', $reply)
                            <div class="w-24 pt-2 flex justify-center">
                                <form action="/replies/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteReply({{ $reply->id }})" class="h-8 px-2 py-1 text-red-500 border border-red-500 font-semibold rounded hover:bg-red-100">
                                        削除
                                    </button> 
                                </form>
                            </div>
                        @endcan
                    </div>
                @endforeach
                
                <div class="flex">
                    <div id="reply_{{ $comment->id }}" style="display: none;" class="w-full m-3 pr-6">
                        <form action="/replies" method="POST">
                            @csrf
                            <input type='hidden' name='reply[comment_id]' value="{{ $comment->id }}">
                            <textarea name="reply[reply]" placeholder="ここに返信を入力" class="w-full"></textarea>
                            <p class="reply__error" style="color:red">{{ $errors->first('reply.reply') }}</p>
                            <div class="flex justify-end">
                                <input type="submit" value="保存" class="bg-gray-900 hover:bg-gray-900 text-white rounded px-1 py-1"/>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="w-full m-3 pr-6">
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

            function Comment_mode(id){
                'use strict'
                if(document.getElementById(`view_comment_${id}`).style.display === "block"){
                    document.getElementById(`view_comment_${id}`).style.display = "none";
                    document.getElementById(`edit_comment_${id}`).style.display = "block";
                    document.getElementById(`comment_mode_button_${id}`).textContent = "戻る";
                }else{
                    document.getElementById(`view_comment_${id}`).style.display = "block";
                    document.getElementById(`edit_comment_${id}`).style.display = "none";
                    document.getElementById(`comment_mode_button_${id}`).textContent = "編集";
                }
            }
            
            function Reply(id){
                'use strict'
                if(document.getElementById(`reply_${id}`).style.display === "none"){
                    document.getElementById(`reply_${id}`).style.display = "block";
                    document.getElementById(`reply_button_${id}`).textContent = "戻る";
                }else{
                    document.getElementById(`reply_${id}`).style.display = "none";
                    document.getElementById(`reply_button_${id}`).textContent = "返信";
                }
            }
            
            function Reply_mode(id){
                'use strict'
                if(document.getElementById(`view_reply_${id}`).style.display === "block"){
                    document.getElementById(`view_reply_${id}`).style.display = "none";
                    document.getElementById(`edit_reply_${id}`).style.display = "block";
                    document.getElementById(`reply_mode_button_${id}`).textContent = "戻る";
                }else{
                    document.getElementById(`view_reply_${id}`).style.display = "block";
                    document.getElementById(`edit_reply_${id}`).style.display = "none";
                    document.getElementById(`reply_mode_button_${id}`).textContent = "編集";
                }
            }
        </script>
</x-app-layout>