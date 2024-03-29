<x-app-layout>
    <x-slot name="header">
        <title>棋譜投稿サイト</title>
        <h1>投稿一覧</h1>
    </x-slot>
        <div class="m-3 w-20 px-2 py-1 bg-blue-400 text-white font-semibold rounded hover:bg-blue-500">
            <a href='records/create'>新規投稿</a>
        </div>
        
        <div>
            <form action="/" method="GET">
                @csrf
                <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </form>
        </div>
        
        @foreach($records as $record)
            <div class="m-1 border-2 border-red-700">
                <div class="flex">
                    <div class="w-full pl-3">
                        <p class="text-sm">
                            投稿者：{{ $record->user->name }}
                        </p>
                        <a href="/records/{{ $record->id }}" class="text-3xl font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                            {{ $record->title }}
                        </a>
                    </div>

                    @can('delete', $record)
                        <div class="w-20 flex justify-center pt-3">
                            <form action="/records/{{ $record->id }}" id="form_{{ $record->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $record->id }})" class="px-2 py-1 bg-red-400 text-white font-semibold rounded hover:bg-red-500">
                                    削除
                                </button> 
                            </form>
                        </div>
                    @endcan
                </div>
                
                <p class="pl-3 py-1 text-2xl">
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
                    <p class="pl-7 py-1">備考：{{ $record->remark }}</p>
                @endisset
                
                <p class="text-sm pl-7 py-1">コメント数：{{ count($record->comments) }}</p>
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
        </script>
</x-app-layout>