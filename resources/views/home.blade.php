@extends('layouts.app')

@section('content')
@php
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\TweetController;

$following = new FollowingController();
$tweets = $following->get_followings_tweets();
@endphp
<div class="container">
{{------------- add new tweet section ------------}}
<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <form action="{{ route('addNewTweet' , Auth::user()->id)}}" method="POST">
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold" style="font-size: 18pt">New Tweet</h4>
        <button type="button" class="close btn-info" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label data-error="wrong" data-success="right" for="exampleFormControlTextarea1" class="w-70 font-weight-bold text-info">
              Type Your Tweet And share Your Thoughts.... </label>
    
        <textarea class="form-control validate" id="exampleFormControlTextarea1" rows="5" name="tweet"></textarea>
        </div>

      </div>
      <div class="modal-footer d-flex" style="">
        <button class="btn btn-info" type="submit" style="color: white; font-size:16pt">Share!</button>
   
      </div>
    </div>
  </div>
</form> 
</div>
{{-- /*-----------------------------------------------*/ --}}



<div class="text-center">
  <a href="" class="btn btn-success btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">
      Add new Tweet!
  </a>
</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
    @foreach ($tweets as $tweet)
    <div class="card" style="margin:20px;">
        <div class="card-header">

          <div class="row">
            <div class="d-inline">
              <img src="{{asset($tweet->avatar)}}" 
              alt=""  
              style="height:50px; width:50px; border-radius:50%; margin-right:5px;">
            </div>
            <div>
              <h4 style=" margin-top:10%">{{$tweet->ownerName}}</h4>
            </div>
            <div class="col-md-2 ml-auto">
              {{$tweet->created_at}}
            </div>
          </div>
          
          
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div style="font-size: 18pt">
                    {{$tweet->tweet}}

            </div>
        </div>

        @php
                   $Tweet = new TweetController();
                   $is_like = $Tweet->is_like($tweet->id);
                   $num_likes = $Tweet->get_number_of_likes($tweet->id);
        @endphp
        <div class="card-footer text-muted">
            {{$num_likes}} likes

            @if ($is_like ==true)
            <form action="{{Route('unlikeTweet',$tweet->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" 
            class="btn btn-primary btn-sm float-right " style="font-size: 12pt">Unlike</button>
            </form>   
              @else
              <form action="{{Route('likeTweet', $tweet->id)}}" method="GET">
                @csrf
                <button type="submit"
                  class="btn btn-primary float-right" style="font-size: 12pt">Like</button>
                </form>
              
            @endif

          </div>
    </div>
    @endforeach
    
            </div>
        </div>
    </div>
</div>
@endsection
