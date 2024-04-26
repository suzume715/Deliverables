<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function records()   
    {
        return $this->hasMany(Record::class);  
    }
    
    public function comments()   
    {
        return $this->hasMany(Comment::class);  
    }
    
    public function replies()   
    {
        return $this->hasMany(Reply::class);  
    }
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
    
    public function bookmark_records()
    {
        return $this->belongsToMany(Record::class, 'bookmarks', 'user_id', 'record_id');
    }
    
    public function is_bookmark($recordId)
    {
        return $this->bookmarks()->where('record_id', $recordId)->exists();
    }
}
