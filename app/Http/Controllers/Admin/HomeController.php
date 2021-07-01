<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // serve per interagire con l'utente


//controller privato che punta la cartella admin

class HomeController extends Controller
{
    public function index()
    {
        // $user = Auth::user(); // serve per interagire con l'utente
        // dump($user->name);
        return view('admin.home');
    }
}
