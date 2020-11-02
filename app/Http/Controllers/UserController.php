<?php

namespace App\Http\Controllers;

use App\Following;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Http\Controllers\FollowingController;


class UserController extends Controller
{
    public function manageProfile($userId)
    {
        $record = User::findOrFail($userId);
        return view('/user_views/manageProfile' , ['record' => $record]);
    }

    public function editProfileInfo($id, $flag)
    {
        $record = User::findOrFail($id);

        if($flag == 'name')
               { $record->name = request('name'); }
        else if($flag == 'email')
                    { $record->email = request('email'); }

        else if($flag == 'avatar'){

            $avatar_uploaded =  request()->file('avatar');
            $avatar_name = time() . '.' . $avatar_uploaded->getClientOriginalExtension();
            $avatar_path = public_path('/img/');
            $avatar_uploaded->move($avatar_path, $avatar_name); 

            $record->avatar = '/img/' . $avatar_name; 
        }

        else if($flag == 'password'){ 
            $record->password =  Hash::make(request('password'));
         }
        
        $record->save();
        return view('/home');
    }

    public function showUsers($userId)
    {
        $users = DB::table('users')->where('id', '!=', $userId)->get();

        return view('user_views.showAllUsers' , ['users' => $users]);
    }

    public function show_specific_user_profile($userId)
    {
        $userRecord = User::findOrFail($userId);

        $userTweets = DB::table('tweets')
        ->where('ownerId', '=', $userId)
        ->orderBy('created_at', 'desc')
        ->get();

        $user =auth()->user();
        $isFollow = false;
        $followings = DB::table('followings')->get();
        foreach($followings as $following)
        {
            if($following->following_id == $userId && $following->user_id== $user->id){
                $isFollow = true;
            }
        }

        $followings_num = (new FollowingController)-> get_number_of_followings($userId);

        $followers_num = (new FollowingController)-> get_number_of_followers($userId);
        
        return view('user_views.showSpecificUser',
        ['user' => $userRecord ,
         'userTweets' => $userTweets,
         'isfollow' =>$isFollow,
         'followings' =>$followings_num,
         'followers' =>$followers_num,

         ]);
    }
}
