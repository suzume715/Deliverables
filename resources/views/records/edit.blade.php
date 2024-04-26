<x-app-layout>
    {{--<x-slot name="header">
        <meta charset="utf-8">
        <title>棋譜投稿サイト</title>
        <h1>編集</h1>
    </x-slot>--}}
    
    <div class="max-w-[50rem] mx-auto">
        <form action="/records/{{ $record->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="pt-3 pb-1 px-3">
                <h2>タイトル<span class="text-red-600">（必須）</span></h2>
                <input type="text" name="record[title]" placeholder="ここにタイトルを入力" value="{{ old('record.title', $record->title) }}" class="w-full"/>
                <p class="title__error" style="color:red">{{ $errors->first('record.title') }}</p>
            </div>
            
            <div class="pl-3 py-1">
                <h2>棋譜ファイル</h2>
                <p class="text-orange-500">アップロード可能な拡張子：.kif</p>
                <p class="text-orange-500">何もアップロードしなければ、編集前の棋譜が保持されます。</p>
                <input type="file" name="kif">
                <p class="file__error" style="color:red">{{ $errors->first('kif') }}</p>
                <p class="file__error" style="color:red">{{ $errors->first('record.record') }}</p>
            </div>
            
            <div class="px-3 py-1 flex flex-wrap">
                <div class="w-1/2 min-w-80">
                    <h2>先手の名前</h2>
                    <input type="text" name="record[first_player_name]" placeholder="ここに先手の名前を入力" value="{{ old('record.first_player_name', $record->first_player_name) }}" class="w-full"/>
                    <p class="first_player_name__error" style="color:red">{{ $errors->first('record.first_player_name') }}</p>
                </div>
                
                <div class="w-1/2 min-w-80">
                    <h2>後手の名前</h2>
                    <input type="text" name="record[second_player_name]" placeholder="ここに後手の名前を入力" value="{{ old('record.second_player_name', $record->second_player_name) }}" class="w-full"/>
                    <p class="second_player_name__error" style="color:red">{{ $errors->first('record.second_player_name') }}</p>
                </div>
            </div>
            
            <div class="px-3 py-1 flex flex-wrap">
                <div class="w-1/2 min-w-80">
                    <h2>先手の戦法</h2>
                    <input type="text" name="record[first_player_strategy]" placeholder="ここに先手の戦法を入力" value="{{ old('record.first_player_strategy', $record->first_player_strategy) }}" class="w-full"/>
                    <p class="first_player_strategy__error" style="color:red">{{ $errors->first('record.first_player_strategy') }}</p>
                </div>
                <div class="w-1/2 min-w-80">
                    <h2>後手の戦法</h2>
                    <input type="text" name="record[second_player_strategy]" placeholder="ここに後手の戦法を入力" value="{{ old('record.second_player_strategy', $record->second_player_strategy) }}" class="w-full"/>
                    <p class="second_player_strategy__error" style="color:red">{{ $errors->first('record.second_player_strategy') }}</p>
                </div>
            </div>
            
            <div class="px-3 py-1 flex flex-wrap">
                <div class="w-1/2 min-w-80">
                    <h2>先手の囲い</h2>
                    <input type="text" name="record[first_player_castle]" placeholder="ここに先手の囲いを入力" value="{{ old('record.first_player_castle', $record->first_player_castle) }}" class="w-full"/>
                    <p class="first_player_castle__error" style="color:red">{{ $errors->first('record.first_player_castle') }}</p>
                </div>
                <div class="w-1/2 min-w-80">
                    <h2>後手の囲い</h2>
                    <input type="text" name="record[second_player_castle]" placeholder="ここに後手の囲いを入力" value="{{ old('record.second_player_castle', $record->second_player_castle) }}" class="w-full"/>
                    <p class="second_player_castle__error" style="color:red">{{ $errors->first('record.second_player_castle') }}</p>
                </div>
            </div>
            
            <div class="px-3 py-1">
                <h2>詳しい説明</h2>
                <textarea name="record[remark]" style="field-sizing: content;" placeholder="ここに説明を入力" class="w-full">{{ old('record.remark', $record->remark) }}</textarea>
                {{--<input type="text" name="record[remark]" placeholder="詳細な説明" value="{{ old('record.remark') }}"/>--}}
                <p class="remark__error" style="color:red">{{ $errors->first('record.remark') }}</p>
            </div>
            
            <div class="flex justify-end mb-3">
                <input type="submit" class="bg-[#0636C5] hover:bg-[#0636C5] hover:opacity-50 text-white rounded px-3 py-1 mr-3" value="保存"/>
            </div>
        </form>
        
        <div class="flex justify-start mb-3">
            <a href="/records/{{ $record->id }}" class="bg-white hover:bg-white hover:opacity-50 text-[#0636C5] rounded px-3 py-1">この投稿の詳細画面へ</a>
        </div>
    </div>
</x-app-layout>