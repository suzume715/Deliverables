<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Http\Requests\RecordRequest;

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
    
    public function store(RecordRequest $request, Record $record)
    {
        //$validated = $request->validate([
        //    'kif' => 'required'
        //]);
        $input = $request['record'];
        $input += ['user_id' => $request->user()->id];
        $input += ['record' => mb_convert_encoding(file_get_contents($request->file('kif')), "utf-8", "SJIS-win")];
        $record->fill($input)->save();
        //$file = $request->file('kif');
        //$fileName = $file->getClientOriginalExtension();
        //var_dump($fileName);
        return redirect('/records/' . $record->id);
    }
    
    public function edit(Record $record)
    {
        return view('records.edit')->with(['record' => $record]);
    }
    
    public function update(RecordRequest $request, Record $record)
    {
        $input = $request['record'];
        $input += ['user_id' => $request->user()->id];
        $input += ['record' => mb_convert_encoding(file_get_contents($request->file('kif')), "utf-8", "SJIS-win")];
        $record->fill($input)->save();
        return redirect('/records/' . $record->id);
    }
    
    public function delete(Record $record)
    {
        $record->delete();
        return redirect('/');
    }
}
