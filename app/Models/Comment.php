<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function user()   
    {
        return $this->belongsTo(User::class);  
    }
    
    public function record()   
    {
        return $this->belongsTo(Record::class);  
    }
    
    public function replies()   
    {
        return $this->hasMany(Reply::class);  
    }
    
    protected $fillable = [
        'user_id',
        'record_id',
        'comment'
    ];
}
