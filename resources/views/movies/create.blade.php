@extends('layouts.app')

@section('title', 'MovieDeck | Find the best movies!')

@section('content')
    <div class="container mx-auto flex px-5 py-16 md:flex-row flex-col items-start align-top">
        <div class="flex flex-col w-3/4 md:items-start md:text-left mr-10 mb-16 md:mb-0 items-center text-center bg-white p-12">
            <h1 class="font-medium text-gray-500 text-4xl mb-6">Add a Movie </h1>
            @if ($errors->any())
                <div class="text-red-500 bg-red-100 border border-2 border-red-400 rounded rounded-md p-6 m-2 w-full">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="flex w-full justify-between">
                <form method="POST" action="{{ route('movies.store') }}" class="mx-auto w-full">
                    @csrf
                    <div class="flex flex-col">
                        <div class="flex py-6">
                            <div class="w-1/2">
                                <label for="title"> Title:
                                    <input type="text" name="title" value="{{ old('title') }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label for="year"> Year:
                                    <input type="text" name="year" value="{{ old('year') }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400"> 4-digit format </span>
                                </label>
                            </div>
                        </div>

                        <label for="synopsis"> Synopsis:
                            <textarea type="text" name="synopsis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('synopsis') }}</textarea>
                        </label>

                        <div class="flex py-6">
                            <div class="w-1/2">
                                <label for="poster"> Poster:
                                    <input type="text" name="poster" value="{{ old('poster') }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400"> Photo URL </span>
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label for="banner"> Banner:
                                    <input type="text" name="banner" value="{{ old('banner') }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400"> Photo URL </span>
                                </label>
                            </div>
                        </div>

                        <div class="flex py-6">
                            <div class="w-1/2">
                                <label for="trailer"> Trailer:
                                    <input type="text" name="trailer" value="{{ old('trailer') }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400">YouTube, Vimeo, etc. </span>
                                </label>
                            </div>
                            <div class="w-1/2">
                                <label for="duration"> Duration:
                                    <input type="text" name="duration" value="{{ old('duration') }}" class="mt-1 block w-3/4 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="text-sm text-gray-400">in minutes</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col mb-6 mt-16">
                        <h1 class="font-medium text-gray-500 text-2xl">Genres</h1>
                        <span class="text-sm text-gray-400 py-4"> Select one or more genre: </span>
                    </div>
                    <div class="h-auto grid grid-rows-3 grid-flow-col gap-2">
                        @foreach($genres as $genre)
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                       @if(in_array($genre->id,old('genres',[]))) checked  @endif
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                                <span class="ml-2 text-gray-600 font-medium text-md">{{ $genre->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="flex flex-col mb-6 mt-16">
                        <h1 class="font-medium text-gray-500 text-2xl">Casts</h1>
                        <span class="text-sm text-gray-400 py-4"> Select from our list of celebrities: </span>
                    </div>
                    <div class="flex flex-col">
                        @foreach($celebs as $celeb)
                            <div>
                                <label class="flex flex-row justify-between align-middle mt-3">
                                    <div>
                                        <input {{ $celeb->value ? 'checked' : null }}
                                               data-id="{{ $celeb->id }}" type="checkbox"
                                               class="celeb-enable rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-gray-600 font-medium text-md align-middle">{{ $celeb->name }}</span>
                                    </div>
                                    <input value="{{ $celeb->value ?? null }}" {{ $celeb->value ? null : 'disabled' }} data-id="{{ $celeb->id }}" name="celebs[{{ $celeb->id }}]" type="text" placeholder="as character"
                                           class="celeb-character form-control mt-1 mx-2 align-middle w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col mt-10">
                        <div class="flex flex-row align-middle items-center">
                            <button type="submit" class="flex w-max px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Add</button>
                            <a class="text-gray-400 hover:text-gray-600 px-4 py-2" href="{{ route('movies.index') }}">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-1/4 flex flex-col items-end mb-16 md:mb-0">
            <div class="flex-col pb-6">
                <img class="flex w-80 border rounded-sm mb-4 align-middle justify-end" src="https://everyfad.com/static/images/movie_poster_placeholder.29ca1c87.svg" alt="movie_poster_placeholder">
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.celeb-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.celeb-character[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.celeb-character[data-id="' + id + '"]').val(null)
            })
        });
    </script>
@endsection
