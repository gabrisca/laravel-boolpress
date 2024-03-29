@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            Modifica
            <a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a>
        </h1>
        {{-- gestore degli errori: verifica l'esistenza di errori --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="label-control" for="title">Titolo</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                        class="form-control @error('title') is-invalid @enderror">
                    {{-- se esiste l'errore title --}}
                    @error('title')
                        {{-- stampa un messaggio di errore --}}
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="label-control" for="category_id">Categoria</label>
                    <select class="form-control @error('category_id') is-invalid @enderror"
                    name="category_id" id="category_id">
                        <option value=""> - selezionare una categoria - </option>
                        @foreach($categories as $category)
                            <option
                            @if(old('category_id', $post->category_id) == $category->id)   selected @endif
                            value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="label-control" for="content">Contenuto</label>
                    <textarea type="text" id="content" name="content"
                        class="form-control @error('content') is-invalid  @enderror"
                        rows="6">{{ old('content', $post->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <h5>Tags</h5>
                    @foreach ($tags as $tag)
                        <span class="d-inline-block mr-3">
                            <input
                            type="checkbox"
                            id="tag{{ $loop->iteration }}"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            @if (in_array($tag->id,old('tags',[])) && $errors->any()) checked
                            @elseif (!$errors->any() && $post->tags->contains($tag->id)) checked
                            @endif
                            >
                            <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                        </span>
                    @endforeach
                </div>
                {{-- <div class="mb-3">
                    <h5>Tag</h5>
                    @foreach ($tags as $tag)
                    <span class="d-inline-block mr-3"> --}}
                        {{-- id="tag{{ $loop->iteration }} genera diverse iterazioni (numeri univoci) --}}
                        {{-- name="tags[]" dice di riempire l'array tags con il value selezionato --}}
                        {{-- nel value mettere sempre l'id --}}
                        {{-- <input
                        type="checkbox"
                        id="tag{{ $loop->iteration }}"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        @if ($errors->any() && in_array($tag->id, old('tags,[]')))
                            checked
                            @elseif (!$errors->any() && $post->tags->contain($tag->id))
                            checked
                        @endif
                        >
                        {{--  --}}
                        {{-- <label for="tag{{ $loop->iteration }}">{{ $tag->name }}</label>
                    </span>
                    @endforeach

                    @error('tags')
                    {{-- stampa un messaggio di errore --}}
                    {{-- <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div>
                    <button class="btn btn-primary" type="submit">
                        INVIO
                    </button>
                    <button class="btn btn-secondary" type="reset">
                        RESET
                    </button>
                    <a class="btn btn-success" href="{{ route('admin.posts.index') }}">BACK</a>
                </div>
            </form>
        </div>
    @endsection
