<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Following;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;


class FollowingController extends Controller

{
    
    public function follow($followingUserId)
    {
        $followerRecord = new Following();
        $followerRecord->following_id = $followingUserId;
        $followerRecord->user_id = auth()->user()->id;
    
        $followerRecord->save();
        return redirect()->action(
            'UserController@show_specific_user_profile', ['userId' => $followingUserId]
        );
    }

    public function unfollow($unfollowingUserId)
    {
        $followerRecord = DB::table('followings')
        ->where([
            ['following_id', '=', $unfollowingUserId],
            ['user_id', '=', auth()->user()->id],
        ])->delete();

        return redirect()->action(
            'UserController@show_specific_user_profile', ['userId' => $unfollowingUserId]
        ); 

    }

    public function get_number_of_followings($userId)
    {
        $followingsList = DB::table('followings')->where('user_id', $userId);
        $followings_Count = $followingsList->count();

        return $followings_Count;
    }

    public function get_number_of_followers($userId)
    {
        $followersList = DB::table('followings')->where('following_id', $userId);
        $followers_Count = $followersList->count();

        return $followers_Count;
    }

    public function get_followings_tweets()
    {
        $followings_tweets =  DB::table('followings')
        ->where('user_id' , '=' , auth()->user()->id)
        ->join('tweets', 'followings.following_id', '=', 'tweets.ownerId')
        ->join('users', 'followings.following_id', '=', 'users.id')
        ->select('users.avatar', 'tweets.*')
        ->orderBy('created_at', 'asc')
        ->get();

        return $followings_tweets;
    }
}
