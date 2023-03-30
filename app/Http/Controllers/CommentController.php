<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feeds;
Use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CommentController extends Controller
{
    public function __construct(){
        
    }

    public function commentStore(Request $request){
      if($request->reply == 1){
        $query = DB::table('comment');
        $query->select('comment_id','feeds_id','parent_id','comment','user_id','created_at');
        $query->where('feeds_id', $request->id);
        $query->where('parent_id',0);
        $query->orderBy('comment_id', 'ASC');
        $commentsResult = $query->get();
         $commentHTML = '';
        foreach($commentsResult as $comment){
          $commentHTML .= '
            <div class="panel panel-primary">
            <div class="panel-heading">By <b>'.Auth::user()->name.'</b> on <i>'.$comment->created_at.'</i></div>
            <div class="panel-body">'.$comment->comment.'</div>
            <div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment->comment_id.'" data-feed="'.$comment->feeds_id.'">Reply</button></div>
            </div> ';
         $commentHTML .= $this->getCommentReply($comment->comment_id);
        }
       echo $commentHTML;
      }else{

        $feed=Feeds::where('id',$request->id)->first();

        if($feed){
         comment::create([
               'user_id'=>Auth::user()->id,
               'feeds_id' =>$request->id,
               'parent_id' => $request->parent_id,
               'comment' => $request->comment,
              
             ]);
             $query = DB::table('comment');
             $query->select('comment');
             $query->where('feeds_id', $request->id);
             $commentshow = $query->get();
             return  $commentshow;
       ;
           
        }else{
           redirect()->back()->with('Message',"no post found");
        }
      }
      




}


public function getCommentReply($pid=0,$marginLeft = 0) {
  $query = DB::table('comment');
  $query->select('comment_id','feeds_id','parent_id','comment','user_id','created_at');
  $query->where('parent_id', $pid);
  $query->orderBy('comment_id', 'ASC');
  $commentsResult = $query->get();
  //$commentsCount =  $query->get()->count();
   $commentHTML = '';
  
	if($pid == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	//if($commentsCount > 0) {
    foreach($commentsResult as $comment){ 
			$commentHTML .= '
				<div class="panel panel-primary" style="margin-left:'.$marginLeft.'px">
				<div class="panel-heading">By <b>'.Auth::user()->name.'</b> on <i>'.$comment->created_at.'</i></div>
				<div class="panel-body">'.$comment->comment.'</div>
				<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment->comment_id.'" data-feed="'.$comment->feeds_id.'">Reply</button></div>
				</div>
				';
			$commentHTML .= $this->getCommentReply($comment->comment_id ,$marginLeft);
		}
	//}
	return  $commentHTML;
}

}