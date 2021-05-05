@extends('layouts.app')

@section('title', 'MovieDeck | Find the best movies!')

@section('content')
    <div class="container mx-auto flex px-5 py-16 md:flex-row flex-col items-start align-top">
        <div class="flex flex-col w-3/4 md:items-start md:text-left mr-10 mb-16 md:mb-0 items-center text-center bg-white p-12">
            <h1 class="font-medium text-gray-500 text-4xl mb-6">Edit
                <span class="text-blue-500">
                    <a href="{{ route('movies.show', $movie) }}" target="_blank">{{ $movie->title }}</a>
                </span>
            </h1>
            @if ($errors->any())
                <div class="text-red-500 bg-red-100 border border-2 border-red-400 rounded rounded-md p-6 m-2 w-full">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="flex w-full justify-between">
                <form method="POST" action="{{ route('movies.update', $movie) }}" class="mx-auto w-full">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col">
                        <div class="flex py-6">
                            <div class="w-1/2">
                                <label for="title"> Title:
                                    <input type="text" name="title" value="{{ $movie->title }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label for="year"> Year:
                                    <input type="text" name="year" value="{{ $movie->year }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400"> 4-digit format </span>
                                </label>
                            </div>
                        </div>

                        <label for="synopsis"> Synopsis:
                            <textarea type="text" name="synopsis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $movie->synopsis }}</textarea>
                        </label>

                        <div class="flex py-6">
                            <div class="w-1/2">
                                <label for="poster"> Poster:
                                    <input type="text" name="poster" value="{{ $movie->poster }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400"> Photo URL </span>
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label for="banner"> Banner:
                                    <input type="text" name="banner" value="{{ $movie->banner }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400"> Photo URL </span>
                                </label>
                            </div>
                        </div>

                        <div class="flex py-6">
                            <div class="w-1/2">
                                <label for="trailer"> Trailer:
                                    <input type="text" name="trailer" value="{{ $movie->trailer }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400">YouTube, Vimeo, etc. </span>
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label for="duration"> Duration:
                                    <input type="text" name="duration" value="{{ $movie->getRawDuration() }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400">in minutes</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <h1 class="font-medium text-gray-500 text-2xl my-6">Edit Genres</h1>
                    <div class="h-auto grid grid-rows-3 grid-flow-col gap-2">
                        @foreach($genres as $genre)
                            <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" name="genres[]" value="{{ $genre->id }}
                                    @foreach($movie->genres as $movieGenre)
                                        @if($movieGenre->pivot->name == $genre->name) checked @endif
                                    @endforeach">
                                    <span class="ml-2 text-gray-600 font-medium text-md">{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <h1 class="font-medium text-gray-500 text-2xl my-6">Edit Celebs</h1>
                    <div class="h-auto grid grid-cols-2 gap-y-2 gap-x-10">
                        @foreach($celebs as $celeb)
                            <div>
                                <label class="inline-flex items-center mt-3">
                                    <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" name="celebs[]" value="{{ $celeb->id }}">
                                    <span class="ml-2 text-gray-600 font-medium text-md">{{ $celeb->name }}</span>
                                </label>
                                <input type="text" name="character_name" placeholder="as character" class="mt-1 mx-2 align-middle w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                {{--                                <label class="flex flex-row justify-between align-middle mt-3">--}}
                                {{--                                    <div>--}}
                                {{--                                        <input type="checkbox" name="celebs[]" value="{{ $celeb->id }}"  class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">--}}
                                {{--                                        <span class="ml-2 text-gray-600 font-medium text-md align-middle">{{ $celeb->name }}</span>--}}
                                {{--                                    </div>--}}
                                {{--                                    <input type="text" name="celebs[{{ $celeb->id }}]" data-id="{{ $celeb->id }}" placeholder="Character" class="mt-1 mx-2 align-middle w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">--}}
                                {{--                                </label>--}}
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-row mt-6 align-middle items-center">
                            <button type="submit" class="flex w-max px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Add</button>
                            <a class="text-gray-400 hover:text-gray-600 px-4 py-2" href="{{ route('movies.show', $movie) }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-1/4 flex flex-col items-end mb-16 md:mb-0">
            <div class="flex-col pb-6">
                <img class="flex w-80 border rounded-sm mb-4 align-middle justify-end" src="{{ $movie->poster }}" alt="{{ $movie->title }}">
            </div>
        </div>
    </div>
@endsection
