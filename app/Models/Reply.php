<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function user()   
    {
        return $this->belongsTo(User::class);  
    }
    
    public function comment()   
    {
        return $this->belongsTo(Comment::class);  
    }
    
    protected $fillable = [
        'user_id',
        'comment_id',
        'reply'
    ];
}
