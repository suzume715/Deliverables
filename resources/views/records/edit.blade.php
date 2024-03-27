<x-app-layout>
    <x-slot name="header">
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
        <h1>編集</h1>
    </x-slot>
        <form action="/records/{{ $record->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="record[title]" value="{{ old('record.title', $record->title) }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('record.title') }}</p>
            </div>
            <div class="first_player_name">
                <h2>先手</h2>
                <input type="text" name="record[first_player_name]" value="{{ old('record.first_player_name', $record->first_player_name) }}"/>
                <p class="first_player_name__error" style="color:red">{{ $errors->first('record.first_player_name') }}</p>
            </div>
            <div class="second_player_name">
                <h2>後手</h2>
                <input type="text" name="record[second_player_name]" value="{{ old('record.second_player_name', $record->second_player_name) }}"/>
                <p class="second_player_name__error" style="color:red">{{ $errors->first('record.second_player_name') }}</p>
            </div>
            <div class="first_player_strategy">
                <h2>先手の戦型</h2>
                <input type="text" name="record[first_player_strategy]" value="{{ old('record.first_player_strategy', $record->first_player_strategy) }}"/>
                <p class="first_player_strategy__error" style="color:red">{{ $errors->first('record.first_player_strategy') }}</p>
            </div>
            <div class="second_player_strategy">
                <h2>後手の戦型</h2>
                <input type="text" name="record[second_player_strategy]" value="{{ old('record.second_player_strategy', $record->second_player_strategy) }}"/>
                <p class="second_player_strategy__error" style="color:red">{{ $errors->first('record.second_player_strategy') }}</p>
            </div>
            <div class="first_player_castle">
                <h2>先手の囲い</h2>
                <input type="text" name="record[first_player_castle]" value="{{ old('record.first_player_castle', $record->first_player_castle) }}"/>
                <p class="first_player_castle__error" style="color:red">{{ $errors->first('record.first_player_castle') }}</p>
            </div>
            <div class="second_player_castle">
                <h2>後手の囲い</h2>
                <input type="text" name="record[second_player_castle]" value="{{ old('record.second_player_castle', $record->second_player_castle) }}"/>
                <p class="second_player_castle__error" style="color:red">{{ $errors->first('record.second_player_castle') }}</p>
            </div>
            <div class="remark">
                <h2>備考</h2>
                <input type="text" name="record[remark]" value="{{ old('record.remark', $record->remark) }}"/>
                <p class="remark__error" style="color:red">{{ $errors->first('record.remark') }}</p>
            </div>
            <div class="record">
                <h2>棋譜</h2>
                {{--<textarea name="record[record]" placeholder="棋譜"></textarea>--}}
                <input type="file" name="kif">
                <p class="file__error" style="color:red">{{ $errors->first('kif') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="footer">
            <a href="/records/{{ $record->id }}">戻る</a>
        </div>
</x-app-layout>