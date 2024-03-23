<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
        <h1>棋譜投稿サイト</h1>
    </x-slot>
        <h1>新規投稿</h1>
        <form action="/records" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="record[title]" placeholder="タイトル"/>
            </div>
            <div class="first_player_name">
                <h2>先手</h2>
                <input type="text" name="record[first_player_name]" placeholder="先手"/>
            </div>
            <div class="second_player_name">
                <h2>後手</h2>
                <input type="text" name="record[second_player_name]" placeholder="後手"/>
            </div>
            <div class="first_player_strategy">
                <h2>先手の戦型</h2>
                <input type="text" name="record[first_player_strategy]" placeholder="先手の戦型"/>
            </div>
            <div class="second_player_strategy">
                <h2>後手の戦型</h2>
                <input type="text" name="record[second_player_strategy]" placeholder="後手の戦型"/>
            </div>
            <div class="first_player_castle">
                <h2>先手の囲い</h2>
                <input type="text" name="record[first_player_castle]" placeholder="先手の囲い"/>
            </div>
            <div class="second_player_castle">
                <h2>後手の囲い</h2>
                <input type="text" name="record[second_player_castle]" placeholder="後手の囲い"/>
            </div>
            <div class="remark">
                <h2>備考</h2>
                <input type="text" name="record[remark]" placeholder="備考"/>
            </div>
            <div class="record">
                <h2>棋譜</h2>
                {{--<textarea name="record[record]" placeholder="棋譜"></textarea>--}}
                <input type="file" name="kif">
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </x-app-layout>
</html>