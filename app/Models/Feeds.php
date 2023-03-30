<?php

namespace App\Models;
Use App\Models\User;
Use App\Models\comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Feeds extends Model
{
    use HasFactory;
    protected $table = 'feeds';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'file',
        'created_by'
    ];
    protected $appends=['published'];

    
        public function getData(){
            return $this->hasOne( 'App\Models\User','id','created_by');
        }
        public function users(){
            return $this->belongsTO(user::class);
        }
        public function comment(){
            return $this->hasMany(comment::class,'feeds_id','id');
        }
}
