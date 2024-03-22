<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
        <h1>棋譜投稿サイト</h1>
    </x-slot>
        <h1>投稿一覧</h1>
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
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </x-app-layout>
</html>