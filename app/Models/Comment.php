<?php

namespace App\Models;
Use App\Models\User;
Use App\Models\Feeds;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'user_id',
        'feeds_id',
        'comment',
        'parent_id',
        
    ];

    public function users(){

        return $this->belongsTo(user::class,'user_id','id');
    }
    public function feeds(){

        return $this->belongsTo(feeds::class,'feeds_id','id');
    }
    public function comment(){

        return $this->hasMany(user::class, 'parent_id' );
    }
}
