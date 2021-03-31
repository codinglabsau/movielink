<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', ['movies' => $movies]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Movie $movie)
    {
        $genres = Movie::with('genres')->get();
        $castings = Movie::with('celebs')->get();
        $duration = explode('.', (string) round($movie->duration/60, 2));
        return view('movies.show', ['movie' => $movie, 'duration' => $duration, 'castings' => $castings, 'genres' => $genres]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}