<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
        <h1>棋譜投稿サイト</h1>
    </x-slot>
        <h1>編集</h1>
        <form action="/records/{{ $record->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="record[title]" value="{{ $record->title }}"/>
            </div>
            <div class="first_player_name">
                <h2>先手</h2>
                <input type="text" name="record[first_player_name]" value="{{ $record->first_player_name }}"/>
            </div>
            <div class="second_player_name">
                <h2>後手</h2>
                <input type="text" name="record[second_player_name]" value="{{ $record->second_player_name }}"/>
            </div>
            <div class="first_player_strategy">
                <h2>先手の戦型</h2>
                <input type="text" name="record[first_player_strategy]" value="{{ $record->first_player_strategy }}"/>
            </div>
            <div class="second_player_strategy">
                <h2>後手の戦型</h2>
                <input type="text" name="record[second_player_strategy]" value="{{ $record->second_player_strategy }}"/>
            </div>
            <div class="first_player_castle">
                <h2>先手の囲い</h2>
                <input type="text" name="record[first_player_castle]" value="{{ $record->first_player_castle }}"/>
            </div>
            <div class="second_player_castle">
                <h2>後手の囲い</h2>
                <input type="text" name="record[second_player_castle]" value="{{ $record->second_player_castle }}"/>
            </div>
            <div class="remark">
                <h2>備考</h2>
                <input type="text" name="record[remark]" value="{{ $record->remark }}"/>
            </div>
            <div class="record">
                <h2>棋譜</h2>
                {{--<textarea name="record[record]" placeholder="棋譜"></textarea>--}}
                <input type="file" name="kif">
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </x-app-layout>
</html>