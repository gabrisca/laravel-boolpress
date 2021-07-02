@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start mb-3">
            <h1>I miei post</h1>
            <div class="ml-2">
                <a class='btn btn-warning btn-sm' href="{{ route('admin.posts.create') }}">Add Post</a>
            </div>
        </div>
        @if (session('deleted'))
            <div class="alert alert-success" role="alert">
                <strong>{{ session('deleted') }}</strong>
                <span>Dato eliminato correttamente</span>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th >ID</th>
                    <th>Title</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ route('admin.posts.show', $post) }}">SHOW</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post) }}">EDIT</a>
                        </td>
                        {{-- per il bottone delete creo un form con metodo POST --}}
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <section>
            {{ $posts->links() }}
        </section>
    </div>
@endsection
