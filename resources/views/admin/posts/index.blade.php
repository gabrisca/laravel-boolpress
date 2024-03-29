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
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            @if ($post->category)
                                {{ $post->category->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @forelse ($post->tags as $tag )
                            <span class="badge badge-primary">{{ $tag->name }}</span>
                            @empty
                            -
                            @endforelse
                        </td>
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
        @foreach ($categories as $category)
             <h3>{{ $category->name }}</h3>
             <div class="col">
                 @forelse ($category->posts as $post_category)
                     {{-- qui viene stampato quello che trovo --}}
                     <div>
                         <a href="{{ route('admin.posts.show', $post_category) }}">{{ $post_category->title }}</a>
                     </div>
                 @empty
                     {{-- se non trovo nulla stampo quello che metto qui --}}
                     <div>nessun post presente</div>
                 @endforelse
             </div>
        @endforeach
    </div>
@endsection
