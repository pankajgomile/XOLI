<?php

namespace App\Models;

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
        
    ];

    public function users(){

        return $this->belongsTo(user::class);
    }
    public function feeds(){

        return $this->belongsTo(feeds::class);
    }
    public function comment(){

        return $this->hasMany(user::class, 'parenta_id' );
    }
}
