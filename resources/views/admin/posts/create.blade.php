@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Nuovo post
        </h1>

        <div>
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                    <label class="label-control" for="title">Titolo</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="label-control" for="content">Contenuto</label>
                    <textarea type="text" id="content" name="content" class="form-control" rows="6"></textarea>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">
                        invio
                    </button>
                    <button class="btn btn-secondary" type="reset">
                        reset
                    </button>
            </form>
        </div>
    @endsection
