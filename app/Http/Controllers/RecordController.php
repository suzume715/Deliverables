<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;

class RecordController extends Controller
{
    /*public function index(Record $record)
    {
        return view('records.index')->with(['records' => $record->getPaginateByLimit(5)]);
    }*/
    
    public function index(Request $request, Record $record)
    {
        $keyword = $request->input('keyword');
        
        if (isset($request->keyword)) {
            $record=Record::where('title', "LIKE", "%$keyword%")
                ->orwhere('first_player_name', "LIKE", "%$keyword%")
                ->orwhere('second_player_name', "LIKE", "%$keyword%")
                ->orwhere('first_player_strategy', "LIKE", "%$keyword%")
                ->orwhere('second_player_strategy', "LIKE", "%$keyword%")
                ->orwhere('first_player_castle', "LIKE", "%$keyword%")
                ->orwhere('second_player_castle', "LIKE", "%$keyword%");
            }
            
        return view('records.index')->with(['records' => $record->orderBy('updated_at', 'DESC')->paginate(5), 'keyword' => $request->keyword]);
    }
    
    public function show(Record $record)
    {
        return view('records.show')->with(['record' => $record]);
    }
    
    public function create(Record $record)
    {
        return view('records.create');
    }
    
    public function store(RecordRequest $request, Record $record)
    {
        $validated = $request->validate([
            'kif' => 'required'
        ],
        [
            'kif.required' => 'kifファイルは必須です。',
        ]);
        $input = $request['record'];
        $input += ['user_id' => $request->user()->id];
        $input += ['record' => mb_convert_encoding(file_get_contents($request->file('kif')), "utf-8", "SJIS-win")];
        $record->fill($input)->save();
        return redirect('/records/' . $record->id);
    }
    
    public function edit(Record $record)
    {
        $this->authorize('edit', $record);
        return view('records.edit')->with(['record' => $record]);
    }
    
    public function update(RecordRequest $request, Record $record)
    {
        $this->authorize('update', $record);
        $input = $request['record'];
        $input += ['user_id' => $request->user()->id];
        if($request->file('kif') !== null){
            $input['record'] = mb_convert_encoding(file_get_contents($request->file('kif')), "utf-8", "SJIS-win");
        }
        $record->fill($input)->save();
        return redirect('/records/' . $record->id);
    }
    
    public function delete(Record $record)
    {
        $this->authorize('delete', $record);
        $record->delete();
        return redirect('/');
    }
    
    public function userindex(Request $request)
    {
        $records=Record::where('user_id', $request->user()->id);
            
        return view('records.userindex')->with(['records' => $records->orderBy('updated_at', 'DESC')->paginate(5)]);
    }
    
    public function bookmark_records()
    {
        $records = \Auth::user()->bookmark_records()->orderBy('created_at', 'desc')->paginate(5);
        /*$data = [
            'records' => $records,
        ];
        return view('records.bookmarks', $data);*/
        return view('records.userindex')->with(['records' => $records]);
    }
}
