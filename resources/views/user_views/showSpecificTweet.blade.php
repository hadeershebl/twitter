@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('showMyTweets', Auth::user()->id)}}" class="btn btn-light" 
        style="background-color:rgb(235, 233, 233)">Go Back</a>    
    <div class="row justify-content-center">
        <div class="col-md-8" >
    {{--------- show specific tweet and update it section  -------}}
            
    <h2>Edit Your Owen Tweet</h2>
        <div class="card" style="margin:20px;">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div style="font-size: 22px">
                <form action="{{route('updateTweet' , $tweet->id)}}" method="POST">
                    @csrf
                        <textarea class="form-control validate" rows="5" name="newtweet">{{$tweet->tweet}}
                        </textarea>
                        <div class="modal-footer mt-3" style="">
                            <button class="btn btn-success float-right" type="submit" 
                            style=" font-size:16pt">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
