@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="d-flex justify-content-start">
            <h1 class="mr-1">
                {{ $post->title }}
            </h1>

            <div>
                @foreach ($post->tags as $tag )
                    <span class="badge badge-primary">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>

        <h3>
            @if($post->category)
            Categoria: {{ $post->category->name }}
            @else
            Nessuna categoria associata
            @endif
            </h3>

        <p>{{ $post->content }}</p>

        <div>
            <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
            <a class="btn btn-success" href="{{ route('admin.posts.index', $post) }}">BACK</a>
        </div>
    </div>
@endsection
