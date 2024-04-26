<x-app-layout>
    {{--<x-slot name="header">
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
        <h1>投稿詳細</h1>
    </x-slot>--}}
    
    <div id="title_menu_cover" onclick="hideTitleMenu()"
        class="fixed w-full h-full bg-gray-500 left-0 top-0 z-20 opacity-40 hidden">
    </div>
    
    <div id="comment_menu_cover" onclick="hideCommentMenu()"
        class="fixed w-full h-full bg-gray-500 left-0 top-0 z-20 opacity-40 hidden">
    </div>
    
    <div id="reply_menu_cover" onclick="hideReplyMenu()"
        class="fixed w-full h-full bg-gray-500 left-0 top-0 z-20 opacity-40 hidden">
    </div>
        
    <div id="title_area" class="relative">
        <h2 onmouseover="show('title_menu_button')" onmouseleave="hide('title_menu_button')"
            class="pl-3 pt-3 text-3xl">
            {{ $record->title }}
        </h2>
        
        @can('edit', $record)
        <button id="title_menu_button" onmouseover="show('title_menu_button')" class="absolute hidden z-10 right-1 top-1" onclick="showTitleMenu()">
            <svg class="h-6 w-6 text-slate-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                <circle cx="12" cy="12" r="1" />
                <circle cx="12" cy="5" r="1" />
                <circle cx="12" cy="19" r="1" />
            </svg>
        </button>
        @endcan
        
        <div id=title_menu class="absolute z-30 right-3 top-1 bg-white hidden border rounded border-black">
            @can('edit', $record)
                <a href="/records/{{ $record->id }}/edit" onmouseover="selected(this)" onmouseleave="unselected(this)" class="block mt-1 py-1 px-3">
                    投稿を編集する
                </a>
            @endcan
            @can('delete', $record)
                <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onmouseover="selectedDelete(this)" onmouseleave="unselectedDelete(this)" onclick="deletePost({{ $record->id }})" class="mb-1 py-1 px-3 text-red-600">
                        投稿を削除する
                    </button>
                </form>
            @endcan
        </div>
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/kifu-for-js@5/bundle/kifu-for-js.min.js" charset="utf-8"></script>
        <div class="mx-auto my-1 w-[400px]">
            <script type="text/kifu">
                {{ $record->record }}
            </script>
        </div>
        <style>
            .kifuforjs-lite {
                {{--background-color: rgba(222, 184, 135, 0.7);--}}
                background-color: rgba(229, 229, 229, 0.95);
                color: black;
            }
        </style>
            
    <div id="record_information" class="mx-3 mb-3 border border-black">
        <p class="text-2xl">
            棋譜情報
        </p>
        
        <div class="pl-3 flex flex-wrap">
            <div class="flex mr-3">
                <svg class="shrink-0 h-6 w-6 text-slate-900"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                <p>{{ $record->user->name }}</p>
            </div>
        
            <div class="flex">
                <svg class="shrink-0 h-6 w-6 text-slate-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <circle cx="12" cy="12" r="9" />
                    <polyline points="12 7 12 12 15 15" />
                </svg>
            
                <div>
                    {{ $record->created_at->toDateString() }}
                </div>
                
                <svg class="ml-3 shrink-0 h-6 w-6 text-slate-900"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -5v5h5" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 5v-5h-5" />
                </svg>
                
                <div>
                    {{ $record->updated_at->toDateString() }}
                </div>
            </div>
        </div>
            
        <p class="pl-3">
            <span class="inline-block">
            @if($record->first_player_name === null)
                匿名
            @else
                {{ $record->first_player_name }}
            @endif
            </span>
            <span class="inline-block">‐
            @if($record->second_player_name === null)
                匿名
            @else
                {{ $record->second_player_name }}
            @endif
            </span>
        </p>
    
        <p class="pl-3">
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
            <p class="pl-3">
                {!!nl2br(e($record->remark))!!}
            </p>
        @endisset
    </div>
        
    <div class="mx-3 mb-3 border border-black">
        <p class="text-2xl">
            {{ count($record->comments) }}件のコメント
        </p>
        
        @foreach($record->comments as $comment)
            <div class="relative">
                <div id="view_comment_{{ $comment->id }}" 
                    onmouseover="show('comment_menu_button_{{ $comment->id }}')" onmouseleave="hide('comment_menu_button_{{ $comment->id }}')"
                    class="pl-3">
                    <p class="text-blue-500 text-sm">{{ $comment->user->name }}</p>
                    <p>{!!nl2br(e($comment->comment))!!}</p>
                </div>
                
                <div id="edit_comment_{{ $comment->id }}" class="px-3 py-1 hidden bg-blue-100">
                    <form action="/comments/{{ $comment->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <p class="text-blue-500 text-sm">{{ $comment->user->name }}</p>
                        <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
                        <textarea type="text" style="field-sizing: content;" name="comment[comment]" class="w-full">{{ old('comment.comment', $comment->comment) }}</textarea><br>
                        <p class="comment__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
                        <input type="submit" value="保存"/ class="bg-[#0636C5] hover:bg-[#0636C5] hover:opacity-50 text-white rounded px-3 py-1">
                        <button type="button" onclick="hide('edit_comment_{{ $comment->id }}');show('view_comment_{{ $comment->id }}')" class="bg-white hover:bg-white hover:opacity-50 text-[#0636C5] rounded px-3 py-1">
                            キャンセル
                        </button>
                    </form>
                </div>
                
                <button id="comment_menu_button_{{ $comment->id }}" 
                    onmouseover="show('comment_menu_button_{{ $comment->id }}')"
                    class="absolute hidden z-0 right-1 top-1"
                    onclick="showCommentMenu({{ $comment->id }})">
                    <svg class="h-6 w-6 text-slate-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" />
                    </svg>
                </button>
                
                <div id="comment_menu_{{ $comment->id }}" class="absolute hidden z-30 right-3 top-1 bg-white border rounded border-black">
                    <button onclick="Reply({{ $comment->id }})" onmouseover="selected(this)" onmouseleave="unselected(this)" class="block my-1 pt-1 px-3 pb-1">
                        コメントに返信する
                    </button>
                    
                    @can('update', $comment)
                        <hr class="h-px bg-gray-300 border-0">
                        <button onclick="editComment({{ $comment->id }})" onmouseover="selected(this)" onmouseleave="unselected(this)" class="px-3 py-1 mt-1">
                            コメントを編集する
                        </button>
                    @endcan
                    
                    @can('delete', $comment)
                        <form action="/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deleteComment({{ $comment->id }})" onmouseover="selectedDelete(this)" onmouseleave="unselectedDelete(this)" class="mb-1 px-3 py-1 text-red-600">
                                コメントを削除する
                            </button> 
                        </form>
                    @endcan
                </div>
            </div>
            
            @foreach($comment->replies as $reply)
                <div class="relative">
                    <div id="view_reply_{{ $reply->id }}"
                        onmouseover="show('reply_menu_button_{{ $reply->id }}')" onmouseleave="hide('reply_menu_button_{{ $reply->id }}')"
                        class="w-full pl-3">
                        <p class="text-blue-500 pl-6 text-sm">{{ $reply->user->name }}</p>
                        <p class="pl-6">{!!nl2br(e($reply->reply))!!}</p>
                    </div>
                    
                    <div id="edit_reply_{{ $reply->id }}" class="pl-9 pr-3 py-1 hidden bg-blue-100">
                        <form action="/replies/{{ $reply->id }}" method="POST">
                            @csrf
                            @method('PUT')
                             <p class="text-blue-500 text-sm">{{ $reply->user->name }}</p>
                            <input type='hidden' name='reply[comment_id]' value="{{ $comment->id }}">
                            <textarea type="text" style="field-sizing: content;" name="reply[reply]" class="w-full">{{ old('reply.reply', $reply->reply) }}</textarea><br>
                            <p class="reply__error" style="color:red">{{ $errors->first('reply.reply') }}</p>
                            <input type="submit" value="保存"/ class="bg-[#0636C5] hover:bg-[#0636C5] hover:opacity-50 text-white rounded px-3 py-1">
                            <button type="button" onclick="hide('edit_reply_{{ $reply->id }}');show('view_reply_{{ $reply->id }}')" class="bg-white hover:bg-white hover:opacity-50 text-[#0636C5] rounded px-3 py-1">
                                キャンセル
                            </button>
                        </form>
                    </div>
                    
                    @can('update', $reply)
                    <button id="reply_menu_button_{{ $reply->id }}" 
                        onmouseover="show('reply_menu_button_{{ $reply->id }}')"
                        class="absolute hidden z-0 right-1 top-1"
                        onclick="showReplyMenu({{ $reply->id }})">
                        <svg class="h-6 w-6 text-slate-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="12" cy="5" r="1" />
                            <circle cx="12" cy="19" r="1" />
                        </svg>
                    </button>
                    @endcan
                    
                    <div id="reply_menu_{{ $reply->id }}" onmouseover="show(this)" onmouseleave="hide(this)" class="absolute hidden z-30 right-3 top-1 bg-white border rounded border-black">
                        @can('update', $reply)
                            <button type="button" onmouseover="selected(this)" onmouseleave="unselected(this)" onclick="editReply({{ $reply->id }})" class="px-3 py-1 mt-1">
                                返信を編集する
                            </button>
                        @endcan
                        @can('delete', $reply)
                            <form action="/replies/{{ $reply->id }}" id="form_{{ $reply->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onmouseover="selectedDelete(this)" onmouseleave="unselectedDelete(this)" onclick="deleteReply({{ $reply->id }})" class="mb-1 px-3 py-1 text-red-600">
                                    返信を削除する
                                </button> 
                            </form>
                        @endcan
                    </div>
                </div>
            @endforeach
                
                <div id="reply_{{ $comment->id }}" class="pl-9 pr-3 py-1 hidden bg-blue-100">
                    <form action="/replies" method="POST">
                        @csrf
                        <input type='hidden' name='reply[comment_id]' value="{{ $comment->id }}">
                        <textarea name="reply[reply]" style="field-sizing: content;" placeholder="ここに返信を入力" class="w-full"></textarea>
                        <p class="reply__error" style="color:red">{{ $errors->first('reply.reply') }}</p>
                        <input type="submit" value="保存" class="bg-[#0636C5] hover:bg-[#0636C5] hover:opacity-50 text-white rounded px-3 py-1"/>
                        <button type="button" onclick="hide('reply_{{ $comment->id }}')" class="bg-white hover:bg-white hover:opacity-50 text-[#0636C5] rounded px-3 py-1">
                            キャンセル
                        </button>
                    </form>
                </div>
        @endforeach
    </div>
    
    <div class="w-full p-3">
        <form action="/comments" method="POST">
            @csrf
            <input type='hidden' name='comment[record_id]' value="{{ $record->id }}">
            <textarea name="comment[comment]" style="field-sizing: content;" placeholder="ここにコメントを入力" class="w-full"></textarea>
            <p class="comment__error" style="color:red">{{ $errors->first('comment.comment') }}</p>
            <div class="flex justify-end">
                <input type="submit" value="送信" class="bg-[#0636C5] hover:bg-[#0636C5] hover:opacity-50 text-white rounded px-3 py-1"/>
            </div>
        </form>
    </div>
    
        
        {{--
        
        <div class="flex">
            <div class="m-3">
                <a href="/" class="px-2 py-1 bg-blue-400 text-white font-semibold rounded hover:bg-blue-500">戻る</a>
            </div>
        </div>--}}
        
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
            
            function show(elementId) {
                const element = document.getElementById(elementId);
                element.classList.remove("hidden");
                element.classList.add("block");
            }
        
            function hide(elementId) {
                const element = document.getElementById(elementId);
                element.classList.remove("block");
                element.classList.add("hidden");
            }
                        
            function selected(x) {
                x.classList.remove("bg-white", "text-black");
                x.classList.add("bg-[#0636C5]", "text-white");
            }
        
            function unselected(x) {
                x.classList.remove("bg-[#0636C5]", "text-white");
                x.classList.add("bg-white", "text-black");
            }
            
            function selectedDelete(x) {
                x.classList.remove("bg-white", "text-red-600");
                x.classList.add("bg-red-600", "text-white");
            }
        
            function unselectedDelete(x) {
                x.classList.remove("bg-red-600", "text-white");
                x.classList.add("bg-white", "text-red-600");
            }
            
            function showTitleMenu() {
                document.body.classList.add("overflow-hidden");
                hide('title_menu_button');
                show('title_menu');
                show('title_menu_cover');
            }
            
            function hideTitleMenu() {
                document.body.classList.remove("overflow-hidden");
                hide('title_menu');
                hide('title_menu_cover');
            }
            
            let ID = null;
            
            function showCommentMenu(id) {
                document.body.classList.add("overflow-hidden");
                hide(`comment_menu_button_${id}`);
                show(`comment_menu_${id}`);
                show('comment_menu_cover');
                ID = id;
            }
            
            function hideCommentMenu() {
                document.body.classList.remove("overflow-hidden");
                hide('comment_menu_cover');
                hide('comment_menu_' + ID);
                ID = null;
            }
            
            function showReplyMenu(id) {
                document.body.classList.add("overflow-hidden");
                hide(`reply_menu_button_${id}`);
                show(`reply_menu_${id}`);
                show('reply_menu_cover');
                ID = id;
            }
            
            function hideReplyMenu() {
                document.body.classList.remove("overflow-hidden");
                hide('reply_menu_cover');
                hide('reply_menu_' + ID);
                ID = null;
            }
            
            function Reply(id){
                'use strict'
                show(`reply_${id}`);
                hide(`comment_menu_${id}`);
                hide('comment_menu_cover');
                document.body.classList.remove("overflow-hidden");
            }
            
            function editComment(id){
                'use strict'
                hide(`view_comment_${id}`);
                show(`edit_comment_${id}`);
                hide(`comment_menu_${id}`);
                hide('comment_menu_cover');
                document.body.classList.remove("overflow-hidden");
            }
            
            function editReply(id){
                'use strict'
                hide(`view_reply_${id}`);
                show(`edit_reply_${id}`);
                hide(`reply_menu_${id}`);
                hide('reply_menu_cover');
                document.body.classList.remove("overflow-hidden");
            }
        </script>
</x-app-layout>