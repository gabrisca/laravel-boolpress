<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest; // PostRequest
use App\Post;
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
        $posts= Post::all();
        // dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
        while($slug_exist){ // fintanto che esiste uno slug ne genero un altro. In questo modo evito che ci siano due slug uguali
            $title = $data['title'] . '-' . $counter;
            $slug = Str::slug($title, '-');
            $data['slug'] = $slug;
            $slug_exist = Post::where('slug', $slug)->first();
            $counter++;
        }

        $new_post = new Post();

        $new_post->fill($data); // scrive solo i dati fillable scritti nel model Comic

        $new_post->save();

        return redirect()->route('admin.posts.show', $new_post);
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

        if(!$post){
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

        if(!$post){
            abort(404);
        }
        return view('admin.posts.edit', compact('post'));
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

        if($post->title !== $data['title']){
            $slug = Str::slug($data['title'], '-'); // Lo slug è una forma leggibile e valida per l’URL di un post o di una pagina web. Serve per la SEO
            $slug_exist = Post::where('slug', $slug)->first(); //cerca se esiste uno slug
            $counter = 0; // contatore iniziale
            while($slug_exist){ // fintanto che esiste uno slug ne genero un altro. In questo modo evito che ci siano due slug uguali
                $title = $data['title'] . '-' . $counter;
                $slug = Str::slug($title, '-');
                $data['slug'] = $slug;
                $slug_exist = Post::where('slug', $slug)->first();
                $counter++;
            }
        }else{
            $data['slug'] = $post->slug;
        }

        // $data = $request->all();

        // $data['slug'] = Str::slug($post->title, '-'); // slug;

        $post->update($data);

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
