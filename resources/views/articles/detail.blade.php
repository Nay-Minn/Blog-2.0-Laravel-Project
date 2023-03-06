@extends('layouts.app')
@section('content')

<div class="container">

    @if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>

    @endif

    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{$article->title}}</h5>
            <div class="card-subtitle small text-muted mb-2 ">{{$article->created_at->diffForHumans()}}
                By: <b>{{$article->user->name}} </b> | Category: <b class="text-light">{{$article->category->name}}</b>
            </div>

            <p class="card-text">{{$article->body}}</p>
            <button class="btn btn-warning bg-warning-subtle"><a href="{{url("/articles/delete/$article->id")}} "
                    class="text-decoration-none text-warning">Delete</a></button>
            <button class="btn btn-secondary bg-light-border-subtle ms-3 "><a href="{{url("articles/edit/$article->id")}}"
                    class="
                    text-decoration-none text-light">Edit <i class="fa-solid fa-pen-to-square"></i></a></button>
        </div>

    </div>

    {{-- @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif --}}

    <ul class=" list-group my-3">
        <li class=" list-group-item active">
            <b>Comments ({{$article->comments->count()}})</b>
        </li>
        @foreach ($article->comments as $comment)
        <li class=" list-group-item">
            {{$comment->content}}
            @auth
            <a href="{{url("/comments/delete/$comment->id")}}"
                ><i class="fa-solid fa-trash text-danger float-end "></i>
            </a>
            @endauth
            <div class="small mt-2">By: <b>{{$comment->user->name}}</b>, {{$comment->created_at->diffForHumans()}}</div>


        </li>
        @endforeach
    </ul>
    @auth
    <form action="{{url("/comments/add")}}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{$article->id}}">
        <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
        <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-arrow-up-from-bracket"></i> Add
            Comment</button>
    </form>
    @endauth
</div>

@endsection