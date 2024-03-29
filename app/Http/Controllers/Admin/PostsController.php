<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest; // PostRequest
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // importo l'helper delle stringhe per lo slug

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5); // orderby 'desc' mostra l'ultimo fumetto inserito
        // dd($posts);
        $categories = Category::all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // $request->validate([ //validazione dei dati inseriti
        //     'title' => 'required|max:255|min:3', // title deve avere un minimi di 3 caratteri e un massimo di 255
        //     'content' => 'required|min:3' // content deve avere almeno 3 caratteri
        // ]);
        // aggiunta poi in PostRequest


        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-'); // Lo slug è una forma leggibile e valida per l’URL di un post o di una pagina web. Serve per la SEO
        $slug_exist = Post::where('slug', $data['slug'])->first(); //cerca se esiste uno slug
        $counter = 0; // contatore iniziale
        while ($slug_exist) { // fintanto che esiste uno slug ne genero un altro. In questo modo evito che ci siano due slug uguali
            $title = $data['title'] . '-' . $counter;
            $data['slug'] = Str::slug($title, '-');
            $slug_exist = Post::where('slug', $data['slug'])->first();
            $counter++;
        }
        $new_post = new Post();
        $new_post->fill($data); // scrive solo i dati fillable scritti nel model Post

        $new_post->save();
        // dump($new_post);

        // dd($data);
        // verifico se esiste la chiave Tags nell'array $data | esiste solo se ho check del value in create.blade.php
        if (array_key_exists('tags', $data)) {
            // se esiste popolo la tabella pivot con la chiave del post e le chiavi dei tags
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post);
        // dd($new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        $categories = Category::all();

        if (!$post) {
            abort(404);
        }
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();

        if ($post->title !== $data['title']) {
            $slug = Str::slug($data['title'], '-'); // Lo slug è una forma leggibile e valida per l’URL di un post o di una pagina web. Serve per la SEO
            $slug_exist = Post::where('slug', $slug)->first(); //cerca se esiste uno slug
            $counter = 0; // contatore iniziale
            while ($slug_exist) { // fintanto che esiste uno slug ne genero un altro. In questo modo evito che ci siano due slug uguali
                $title = $data['title'] . '-' . $counter;
                $slug = Str::slug($title, '-');
                $data['slug'] = $slug;
                $slug_exist = Post::where('slug', $slug)->first();
                $counter++;
            }
        } else {
            $data['slug'] = $post->slug;
        }

        // $data = $request->all();

        // $data['slug'] = Str::slug($post->title, '-'); // slug;

        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }
}
