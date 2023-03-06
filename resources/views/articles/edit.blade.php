@extends('layouts.app')

@section('content')

<div class="container">
    <form method="post">
        @csrf
        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{$article->title}}" />
        </div>
        <div class="mb-3">
            <label for="body">Body</label>
            <textarea name="body" class="form-control">{{$article->body}}</textarea>
        </div>
        <div class="mb-3">
            <label for="category">Category</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                <option value="{{$category['id']}}" @if ($category->id == $article->category_id)
                    selected
                    @endif
                    >
                    {{$category['name']}}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Article</button>
</div>

@endsection