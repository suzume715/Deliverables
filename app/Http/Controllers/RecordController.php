<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index(Record $record)
    {
        return view('records.index')->with(['records' => $record->getPaginateByLimit()]);
    }
    
    public function show(Record $record)
    {
        return view('records.show')->with(['record' => $record]);
    }
    
    public function create(Record $record)
    {
        return view('records.create');
    }
    
    public function store(Request $request, Record $record)
    {
        $input = $request['record'];
        $input += ['user_id' => $request->user()->id];
        $input += ['record' => mb_convert_encoding(file_get_contents($request->file('kif')), "utf-8", "SJIS-win")];
        $record->fill($input)->save();
        return redirect('/records/' . $record->id);
    }
}
