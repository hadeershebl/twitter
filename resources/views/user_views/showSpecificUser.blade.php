@extends('layouts.app')

@section('content')
@php
use App\Http\Controllers\TweetController;
@endphp
  <a href="{{ route('showUsers' , Auth::user()->id) }}" class="btn btn-light" 
    style="background-color:rgb(235, 233, 233); margin-right:20px;">
    Go Back</a>
<div class="container">
   
     {{-- <!-- user information section --> --}}
     <div class="media " style="background-color:white">
        <img class="mr-3 rounded-left" src="{{asset($user->avatar)}}" 
        alt="Generic placeholder image" style="width: 150px; height:150px">
        <div class="media-body">
          <h3 class="mt-2">{{$user->name}}</h3>

          {{-- following and followers section --}}
        <div class="d-flex flex-row justify-content-around">
          <div class="card border border-white" style="width: 8rem;">
            <div class="card-body">
              <h5 class="card-title">Following</h5>
            <p class="card-text">{{$followings}}</p>
            </div>
          </div>
          <div class="card border border-white" style="width: 8rem;">
            <div class="card-body">
              <h5 class="card-title">Followers</h5>
              <p class="card-text">{{$followers}}</p>
            </div>
          </div>
          {{-- follow btn section --}}
          @if ($isfollow == true)
          <form action="{{route('unfollow' , $user->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button href="" class="btn btn-primary btn-lg mt-4" 
              data-toggle="tooltip" data-placement="top" title="follow now!"
              style="color:white;">UnFollow
            </button>
          </form>
            @else
            <form action="{{route('follow' , $user->id)}}" method="get">
              @csrf
              <button href="" class="btn btn-primary btn-lg mt-4" 
              data-toggle="tooltip" data-placement="top" title="follow now!"
              style="color:white;">Follow
                  <span class="badge badge-light" style="font-size: 12pt">
                     +
                  </span>
              </button>
            </form>
          @endif
            </div>
          </div>
        </div>

      {{-- <!-- ---------------------- --> --}}
    
      {{-- show user's tweets section --}}
      <div class="row justify-content-center">
        <div class="col-9">
            @foreach ($userTweets as $tweet)
            <div class="card" style="margin:20px;">
                <div class="card-header">
                    Posted At {{$tweet->created_at}}
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

                {{-- get number of likes for each tweet(call function) --}}
                @php
                $Tweet = new TweetController();
                $is_like = $Tweet->is_like($tweet->id);
                $num_likes = $Tweet->get_number_of_likes($tweet->id);
             @endphp
       <div class="card-footer text-muted">
         {{$num_likes}} likes

         {{-- like btn section --}}
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
@endsection
