@extends('layouts.app')

@section('content')

@if($act != null)
<div class="container">
    <div class="row py-4 my-5">

    <div class="col-8 col-xs-8">
        <h1 class="text-center mb-5">{{$act->title}}</h1>
        <img src="/storage/cover_images/{{$act->cover_image}}" style="width:500px;" class="image-fluid rounded mx-auto d-block">
        <hr>
            <div class="mx-auto d-block">   
               {!!$act->body!!}
            </div>
    </div>

        <div class="col-4 col-xs-4">

            Share with friends: 
        <a href="{{$act->id}}/twitter"> <i class="fa fa-twitter fa-2x"></i></a>
        <a href="{{$act->id}}/facebook"> <i class="fa fa-facebook fa-2x"></i></a>
        <a href="{{$act->id}}/gplus"> <i class="fa fa-google-plus fa-2x"></i></a>
        <a href="{{$act->id}}/linkedin"> <i class="fa fa-linkedin fa-2x"></i></a>
        <a href="{{$act->id}}/tumblr"> <i class="fa fa-tumblr fa-2x"></i></a>

            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Attribute</th>
                        <th scope="col">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Start Time</th>
                        <td>{{$act->start_time}} </td>
                    </tr>
                    <tr>
                        <th scope="row">End Time</th>
                        <td>{{$act->end_time}} </td>
                    </tr>
                    <tr>
                        <th scope="row">Location</th>
                        <td>{{$act->location}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Number of People</th>
                        <td>{{$act->users->count()}} / {{$act->num_ppl}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Page Views</th>
                        <td>{{$act->page_views}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Publisher</th>
                        <td>{{$act->creator($act->creator_id)->name}}</td>
                    </tr>

                </tbody>

            </table>

            @if($act->users->count() > 0)
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item  justify-content-between aligin-items-center active text-center" style="background-color: black;font-size:16px;"><b>Joined Users</b>
                        <span class="badge badge-danger badge-pill text-align-center" style="padding-top: 0.28rem">{{$act->users->count()}}</span>

                    </li>
                @foreach($act->users as $participant)
                <li class="list-group-item text-center"> {{$participant->name}} </li>
                @endforeach
                </ul>
            @endif

            @if(!Auth::guest())
                @if(Auth::user()->id == $act->creator_id)
                    <a href="/acts/{{$act->id}}/edit" class="btn btn-warning btn-block py-3 my-3">Edit</a>
                    <form action=" {{ action('ActivityController@destroy', $act->id) }} " method="post">
                        <input type="hidden" name="_method" value="Delete">
                        <input type="submit" value="Delete" class="btn btn-danger btn-block my-3 py-3">
                </form>
                @endif
            @endif

            <form action="{{action('UserController@joinAct', $act->id)}}" method="post">
                @csrf
                {{-- <input type="hidden" name="_method" value="Join"> --}}
                <input type="submit" value="Join Activity" class="btn btn-info btn-block py-3 my-3">
            </form>

            <a href="/acts" class="my-3 py-3 btn btn-primary btn-block">Go Back</a>
        </div>

        <div style="display: none;">
            {{$act->addPageView()}}
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="jumbotron text-center offset-md-2 col-md-8">
        <h1>No activity found</h1>
    </div>
</div>
@endif
@endsection