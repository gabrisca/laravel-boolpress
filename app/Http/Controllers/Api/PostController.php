<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = [
        //     'nomi' => ['Gino', 'Pino', 'Tino'],
        //     'level' => 3,
        //     'isValid' => true
        // ];
        // $posts = Post::all(); // metodo 1
        // return response()->json($data);

        $posts = DB::table('posts') // metodo 2
        // seleziono solo le colonne che mi interessa vedere
        ->select(
            'posts.id',
            'posts.title',
            'posts.content',
            'posts.created_at as date',
            'categories.name as category'
        )
        ->join('categories', 'posts.category_id', 'categories.id') // join con la tabella categories
        ->get();


        return response()->json($posts);
        // nell'url inserisci e guarda-> http://127.0.0.1:8000/api/posts


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
