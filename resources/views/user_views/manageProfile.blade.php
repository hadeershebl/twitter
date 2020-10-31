@extends('layouts.app')

@section('content')

<div class="container">
    <a href="/home" class="btn btn-light" 
    style="background-color:rgb(235, 233, 233)">Go Back</a> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>
                    Manage Your Profile Information
                    </h2>
                </div>
{{--------- edit name section -------}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="font-size: 22px">Current User Name : 
                        <div style="color: #50abf1; margin-left:30%">
                            {{$record->name}}
                            
                            <form action="{{ route('editProfileInfo', [Auth::user()->id, 'name'] )}}" method="POST">
                                @csrf
                                <input id="name" type="text" class="
                                @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                >

                           <button type="submit" class="btn btn-success" >edit</button>
                            </form>
                        </div>

                    </div>
                </div>
    {{------ edit email section -------}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="font-size: 22px">Current E-mail : 
                        <div style="color: #50abf1; margin-left:30%">
                            {{$record->email}}
            
                            <form action="{{ route('editProfileInfo', [Auth::user()->id, 'email'] )}}" method="POST">
                                @csrf
                            <input id="email" type="email" class=" 
                                @error('email') is-invalid @enderror" name="email" 
                                value="{{ old('email') }}" required autocomplete="email"
                                >

                           <button type="submit" class="btn btn-success" >edit</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
{{------ edit profile picture section -------}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="font-size: 22px">Current Profile Picture : 
                        <div style="margin-left: 30%; margin-top:2%">
                            <img src="{{asset(Auth::user()->avatar)}}" alt="" 
                        style="height:100px; width:100px; border-radius:20%; margin-bottom:5%">

                        <form action="{{ route('editProfileInfo', [Auth::user()->id, 'avatar'] )}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input id="avatar" type="file" class=" 
                            @error('avatar') is-invalid @enderror" name="avatar" style="margin-left: 20%">

                       <button type="submit" class="btn btn-success" >edit</button>
                        </form>
                        </div>
                        
                    </div>
                </div>

{{------------ edit password section ---------------}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="font-size: 22px">Password :
 
                        <form action="{{ route('editProfileInfo', [Auth::user()->id, 'password'] )}}" method="POST">
                            @csrf
                            <input id="password" type="password" class=" 
                        @error('password') is-invalid @enderror" name="password" 
                        required autocomplete="new-password">

                       <button type="submit" class="btn btn-success" >edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
