<?php

namespace App\Http\Controllers;

use App\Models\Celeb;
use App\Models\Genre;
use App\Models\Movie;
use App\Http\Requests\MovieRequest;
use App\Http\Requests\MovieCastRequest;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('id', 'DESC')->paginate(20);

        return view('movies.index', [
            'movies' => $movies,
        ]);
    }

    public function create()
    {
        $genres = Genre::all();
        $celebs = Celeb::orderBy('name', 'ASC')->get();

        return view('movies.create', [
            'genres' => $genres,
            'celebs' => $celebs
        ]);
    }

    public function store(MovieRequest $request)
    {
        $movie = Movie::create($request->except('genres', 'celebs', 'characters'));

        $genres = $request->input('genres');
        $movie->genres()->sync($genres);

        $results = array_combine($request->input('celebs'), $request->input('characters'));

        $casts = collect($results)
            ->map(function($result) {
                return ['character_name' => $result];
            });
        $movie->celebs()->sync($casts);

        return redirect()->route('movies.index')
            ->with(['message' => 'Sucess! Movie has been added.']);
    }

    public function show(Movie $movie)
    {
        $movie->with([
            'genres',
            'celebs'
        ])->get();

        $reviews = $movie->reviews()->paginate(3);

        return view('movies.show', [
            'movie' => $movie,
            'reviews' => $reviews
        ]);
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        $celebs = Celeb::orderBy('name', 'ASC')->get();

        return view('movies.edit', [
            'movie' => $movie,
            'genres' => $genres,
            'celebs' => $celebs
        ]);
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $movie->update($request->except('genres'));

        $genres = $request->input('genres');
        $movie->genres()->sync($genres);

        return redirect()->route('movies.show', $movie)
            ->with(['message' => 'Sucess! Movie has been updated.']);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')
            ->with(['message' => 'Sucess! Movie has been deleted.']);
    }
}
