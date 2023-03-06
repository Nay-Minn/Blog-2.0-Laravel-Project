@extends('layouts.app')
@section('content')
<div class="container">

    {{$articles->links()}}

    @if (session('info'))
    <div class="alert alert-info">
        {{session('info')}}
    </div>

    @endif

    @foreach ($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title text-light">
                {{$article->title}}
            </h5>
            <div class="card-subtitle mb-2 text-muted small">{{$article->created_at->diffForHumans()}}</div>
            By: <b>{{$article->user->name}}</b>

            <p class="card-text">
                {{$article->body}}
            </p>
            <button class="btn btn-primary bg-primary-subtle"><a class=" text-decoration-none" href="{{url("/articles/detail/$article->id")}}">Details</a></button>
        </div>
    </div>
    @endforeach
    {{$articles->links()}}
</div>
@endsection