<?php

namespace App\Http\Controllers;

use App\Models\Feeds;
use App\Models\User;
use App\Models\Feedslike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Exception;

class FeedsController extends Controller
{

    public function feedForm(Request $request)
    {


        return view('feeds.form');
    }
    // store Feeds Data in database
    public function storeFeedsData(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);
        try {

            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'file' => ($request->file)->getClientOriginalName(),
                'created_by' => Auth::user()->id
            ];
            $originalName = $request->file->getClientOriginalName();
            $path = public_path() . '/FeedsImage';
            if ($request->hasFile('file')) {
                $uplaod = $request->file->move($path, $originalName);

            }
            $response = Feeds::create($input);
        } catch (Exception $e) {
            request()->session()->flash('unsuccessMessage', 'Failed to add feeds !!!');
            return redirect()->back();
        }
        request()->session()->flash('successMessage', 'feeds has been successfully added !!!');
        return redirect('feeds-show');
    }

    // show feeds data 
    public function fetchFeedsData()
    {
       
        // $fetchdata = DB::table('feeds')->leftjoin('users', 'feeds.created_by', '=', 'users.id')
        //     ->select("feeds.*", "users.email")->paginate(3);
    //    dd($fetchdata);
    $fetchdata=Feeds::orderBy('id','DESC')->with('getData')->paginate(3);
   
        $data = compact('fetchdata');
//  dd($data);
        return view('feeds.show')->with($data);

    }

    //store feed like details and counte likes
    public function likeFeedsPosts(Request $request)
    {

        $query = DB::table('feedslikes');
        $query->select('feeds_id');
        $query->where('feeds_id', $request->id);
        $query->where('user_id', Auth::user()->id);
        $isExistuserlike = $query->get()->count();
        if ($isExistuserlike == 0) {
            $input = [
                'feeds_id' => $request->id,
                'user_id' => Auth::user()->id

            ];
            $response = Feedslike::create($input);
            $query = DB::table('feedslikes');
            $query->select('feeds_id');
            $query->where('feeds_id', $request->id);
            $likecount = $query->get()->count();
            return $likecount;
        } else {

            $query = DB::table('feedslikes');
            $query->where('feeds_id', $request->id);
            $query->where('user_id', Auth::user()->id);

            $deletelikes = $query->delete();


            $query = DB::table('feedslikes');
            $query->select('feeds_id');
            $query->where('feeds_id', $request->id);
            $likecount = $query->get()->count();
            return $likecount;
        }


    }
    public function feedsDetails($id){
     $singaldetails= DB::table('feeds')->leftjoin('users', 'feeds.created_by', '=', 'users.id')
     ->select("feeds.*", "users.email")->get();
 $feed=compact('singaldetails');
   
     
        return view('feeds.postdetails')->with ($feed);

    }
    // function for calculat time of post
  
}

