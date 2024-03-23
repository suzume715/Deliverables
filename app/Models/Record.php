<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function user()   
    {
        return $this->belongsTo(User::class);  
    }
    
    public function comments()   
    {
        return $this->hasMany(Comment::class);  
    }
    
    protected $fillable = [
        'title',
        'user_id',
        'first_player_name',
        'second_player_name',
        'first_player_strategy',
        'second_player_strategy',
        'first_player_castle',
        'second_player_castle',
        'remark',
        'record'
    ];
}
