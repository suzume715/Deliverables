<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
        <h1>棋譜投稿サイト</h1>
    </x-slot>
        <h1>投稿一覧</h1>
        <div class='records'>
            @foreach($records as $record)
                <div class='record'>
                    <h2 class='title'>
                        タイトル：
                        <a href="/records/{{ $record->id }}">{{ $record->title }}</a>
                    </h2>
                    <p class='body'>先手：{{ $record->first_player_name }}</p>
                    <p class='body'>後手：{{ $record->second_player_name }}</p>
                    <p class='body'>先手の戦型：{{ $record->first_player_strategy }}</p>
                    <p class='body'>後手の戦型：{{ $record->second_player_strategy }}</p>
                    <p class='body'>先手の囲い：{{ $record->first_player_castle }}</p>
                    <p class='body'>後手の囲い：{{ $record->second_player_castle }}</p>
                    <p class='body'>備考：{{ $record->remark }}</p>
                </div>
            @endforeach    
        </div>
        <div class='paginate'>
            {{ $records->links() }}
        </div>
    </x-app-layout>
</html>