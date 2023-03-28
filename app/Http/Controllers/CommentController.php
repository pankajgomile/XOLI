<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feeds;
Use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(){
        
    }

    public function commentStore(Request $request){
       

 request()->validate([
        'comment' => 'required',
 ]);
 $feed=Feeds::where('id',$request->feeds_id)->first();

 if($feed){
  $da=  comment::create([
        'user_id'=>Auth::user()->id,
        'feeds_id' =>$request->feeds_id,
        'comment' => $request->comment,
      ]);

    
 }else{
    redirect()->back()->with('Message',"no post found");
 }


}

}