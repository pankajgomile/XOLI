<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedslike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'feeds_id',
        
    ];
}
