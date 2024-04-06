<x-app-layout>
    <x-slot name="header">
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
        <h1>新規投稿</h1>
    </x-slot>
        <form action="/records" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="record[title]" placeholder="タイトル" value="{{ old('record.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('record.title') }}</p>
            </div>
            <div class="first_player_name">
                <h2>先手</h2>
                <input type="text" name="record[first_player_name]" placeholder="先手" value="{{ old('record.first_player_name') }}"/>
                <p class="first_player_name__error" style="color:red">{{ $errors->first('record.first_player_name') }}</p>
            </div>
            <div class="second_player_name">
                <h2>後手</h2>
                <input type="text" name="record[second_player_name]" placeholder="後手" value="{{ old('record.second_player_name') }}"/>
                <p class="second_player_name__error" style="color:red">{{ $errors->first('record.second_player_name') }}</p>
            </div>
            <div class="first_player_strategy">
                <h2>先手の戦法</h2>
                <input type="text" name="record[first_player_strategy]" placeholder="先手の戦法" value="{{ old('record.first_player_strategy') }}"/>
                <p class="first_player_strategy__error" style="color:red">{{ $errors->first('record.first_player_strategy') }}</p>
            </div>
            <div class="second_player_strategy">
                <h2>後手の戦法</h2>
                <input type="text" name="record[second_player_strategy]" placeholder="後手の戦法" value="{{ old('record.second_player_strategy') }}"/>
                <p class="second_player_strategy__error" style="color:red">{{ $errors->first('record.second_player_strategy') }}</p>
            </div>
            <div class="first_player_castle">
                <h2>先手の囲い</h2>
                <input type="text" name="record[first_player_castle]" placeholder="先手の囲い" value="{{ old('record.first_player_castle') }}"/>
                <p class="first_player_castle__error" style="color:red">{{ $errors->first('record.first_player_castle') }}</p>
            </div>
            <div class="second_player_castle">
                <h2>後手の囲い</h2>
                <input type="text" name="record[second_player_castle]" placeholder="後手の囲い" value="{{ old('record.second_player_castle') }}"/>
                <p class="second_player_castle__error" style="color:red">{{ $errors->first('record.second_player_castle') }}</p>
            </div>
            <div class="remark">
                <h2>備考</h2>
                <input type="text" name="record[remark]" placeholder="備考" value="{{ old('record.remark') }}"/>
                <p class="remark__error" style="color:red">{{ $errors->first('record.remark') }}</p>
            </div>
            <div class="record">
                <h2>棋譜</h2>
                {{--<textarea name="record[record]" placeholder="棋譜"></textarea>--}}
                <input type="file" name="kif">
                <p class="file__error" style="color:red">{{ $errors->first('kif') }}</p>
                <p class="file__error" style="color:red">{{ $errors->first('record.record') }}</p>
            </div>
            <input type="submit" value="store"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
</x-app-layout>