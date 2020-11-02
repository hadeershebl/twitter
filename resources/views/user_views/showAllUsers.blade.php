@extends('layouts.app')

@section('content')

<div class="container">
  <a href="/home" class="btn btn-light" 
    style="background-color:rgb(235, 233, 233)">Go Back</a> 
    <div class="row justify-content-center">
        <div class="col-9" >
    {{--------- show all users section -------}}
            @foreach ($users as $user)
            <div class="card" style="margin:20px;">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-inline">
                        <img src="{{asset($user->avatar)}}" 
                        alt=""  
                        style="height:90px; width:90px; border-radius:50%; margin-right:5px;">
                    </div>
                    
                    <div class="p-2 d-inline" >
                    <a href="{{ route('show-specific-user-profile' , $user->id)}}" 
                        class="btn btn-lg" style="font-size:18pt">{{$user->name}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
