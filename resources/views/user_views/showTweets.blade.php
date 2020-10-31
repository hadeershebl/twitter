@extends('layouts.app')

@section('content')
@php
use App\Http\Controllers\TweetController;
@endphp
<div class="container">
    
        <a href="/home" class="btn btn-light" 
    style="background-color:rgb(235, 233, 233)">Go Back</a> 
    
    <div class="row justify-content-center">
        <div class="col-md-8" >
@if (session('delete_success') != null) 
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('delete_success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if (session('add_success') != null) 
  <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <strong>{{ session('add_success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if (session('update_success') != null) 
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ session('update_success')}}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
    {{--------- show tweet section -------}}

    @foreach ($tweets as $tweet)
    <div class="card" style="margin:20px;">
        <div class="card-header">
            Posted At {{$tweet->created_at}}

            {{-- delete button --}}
            <form action="{{route('deleteTweet' , $tweet->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger float-right btn-sm" type="submit">
                Delete
            </button>
            </form>

            {{-- update button --}}
            <a class="btn btn-success float-right btn-sm mr-2" href="{{route('showSpecificTweet' , $tweet->id)}}">
                Update
            </a>
            
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
<div class="card-footer text-muted" style="font-size: 13pt">
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
@endsection
