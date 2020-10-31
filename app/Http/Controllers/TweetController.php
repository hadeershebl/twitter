<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\tweet;
use App\User;
use Illuminate\Support\Facades\DB;

class TweetController extends Controller
{
    public function add($ownerid)
    {
        $newTweet = new tweet();
        $ownerRecord = User::findOrFail($ownerid);

        $newTweet->ownerName = $ownerRecord->name;
        $newTweet->ownerId = $ownerid;
        $newTweet->tweet =request('tweet');

        $newTweet->save();

        return  redirect()
                        ->action([TweetController::class, 'showOwnerTweets'], ['id' => $ownerid])
                        ->with('add_success' , 'Your Tweet Added Successfully!');

    }

    public function showOwnerTweets($id)
    {
        $tweets = DB::table('tweets')->where('ownerId', '=', $id)
        ->orderBy('created_at', 'desc')->get();

        return view('user_views.showTweets' , ['tweets' => $tweets]);
       
    }

    public function destroy($id)
    {
        $tweet = DB::table('tweets')->where('id', '=', $id)->delete(); 

        return redirect()->back()->with('delete_success' , 'Your Tweet Deleted Successfully!');

    }

    public function showSpecificTweet($tweetId)
    {
        $tweet = tweet::findOrFail($tweetId);

        return view('user_views.showSpecificTweet' , ['tweet' => $tweet]);
    }

    public function update($tweetId)
    {
        $tweetRecord = tweet::findOrFail($tweetId);

        $tweetRecord->tweet = request('newtweet');

        $tweetRecord->save();

        return  redirect()
        ->action([TweetController::class, 'showOwnerTweets'], ['id' => $tweetRecord->ownerId])
        ->with('update_success' , 'Your Tweet updated Successfully!');
       
    }

    public function like($tweetId)
    {
        $like_record = new Like();

        $like_record->tweet_id = $tweetId;
        $like_record->like_owner_id =auth()->user()->id;
        $like_record->save();

        return redirect()->back();
    }
    public function unlike($tweetId)
    {
        $like_record = DB::table('likes')
        ->where([
            ['tweet_id','=', $tweetId],
            ['like_owner_id','=',auth()->user()->id]
        ])
        ->delete();

        return redirect()->back();
    }

    public function is_like($tweet_id)
    {
        $is_like= false;
        $likes_record = DB::table('likes')
        ->where('tweet_id','=', $tweet_id)->get();

        foreach($likes_record as $like_record){

            if($like_record->like_owner_id == auth()->user()->id)
            {
                $is_like = true;
            }
        }

        return $is_like;
    }

    public function get_number_of_likes($tweetId)
    {
        $likes = DB::table('likes')->
        where('tweet_id','=',$tweetId)
        ->get();
        $likes_count = $likes->count();
        
        return $likes_count;
    }
}
