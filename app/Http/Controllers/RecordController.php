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
}
