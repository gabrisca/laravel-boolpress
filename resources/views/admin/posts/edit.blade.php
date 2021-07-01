@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Modifica
            <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a>
        </h1>

        <div>
            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="label-control" for="title">Titolo</label>
                    <input type="text" id="title" name="title" value="{{ $post->title }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="label-control" for="content">Contenuto</label>
                    <textarea type="text" id="content" name="content" class="form-control"
                        rows="6">{{ $post->content }}</textarea>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">
                        invio
                    </button>
                    <button class="btn btn-secondary" type="reset">
                        reset
                    </button>
                </div>
            </form>
        </div>
    @endsection
