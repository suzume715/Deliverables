<x-app-layout>
        <div id="menu_cover" onclick="hideMenu()"
            class="fixed w-full h-full bg-gray-500 left-0 top-0 z-20 opacity-40 hidden">
        </div>
        
        @foreach($records as $record)
            <div onmouseover="show('menu_button_{{ $record->id }}')" onmouseleave="hide('menu_button_{{ $record->id }}')"
                {{--onclick="location.href='/'"--}}
                class="m-1 border-2 border-black relative">
                
                    <div class="w-full pl-3">
                        <a href="/records/{{ $record->id }}" class="text-3xl font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                            {{ $record->title }}
                        </a>
                    </div>
                
                    <button id="menu_button_{{ $record->id }}" onmouseover="show('menu_button_{{ $record->id }}')" class="absolute hidden z-10 right-1 top-1" onclick="showMenu({{ $record->id }})">
                        <svg class="h-6 w-6 text-slate-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="12" cy="5" r="1" />
                            <circle cx="12" cy="19" r="1" />
                        </svg>
                    </button>
                    
                    <div id="menu_{{ $record->id }}" onmouseover="show(this)" onmouseleave="hide(this)" class="absolute hidden z-30 right-3 top-1 bg-white border rounded border-black">
                        @if (!Auth::user()->is_bookmark($record->id))
                        <form action="{{ route('bookmark.store', $record) }}" method="post">
                            @csrf
                            <button onmouseover="selected(this)" onmouseleave="unselected(this)" class="block my-1 py-1 px-3">
                                お気に入り登録
                            </button>
                        </form>
                        @else
                        <form action="{{ route('bookmark.destroy', $record) }}" method="post">
                            @csrf
                            @method('delete')
                            <button onmouseover="selected(this)" onmouseleave="unselected(this)" class="block my-1 py-1 px-3">
                                お気に入り解除
                            </button>
                        </form>
                        @endif
                        @can('update', $record)
                            <hr class="h-px bg-gray-300 border-0">
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
                
                <div class="pl-9 flex flex-wrap">
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
                    
                <p class="pl-9">
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
            
                <p class="pl-9">
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
                
                <p class="text-sm pl-9 py-1">コメント数：{{ count($record->comments) }}</p>
            </div>
        @endforeach
        
        <div class="p-3">
            {{ $records->links('vendor.pagination.tailwind') }}
        </div>
        
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
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
            
            let ID = null;
            
            function showMenu(id) {
                document.body.classList.add("overflow-hidden");
                hide(`menu_button_${id}`);
                show(`menu_${id}`);
                show('menu_cover');
                ID = id;
            }
            
            function hideMenu() {
                document.body.classList.remove("overflow-hidden");
                hide('menu_cover');
                hide('menu_' + ID);
                ID = null;
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
        </script>
</x-app-layout>