<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        #sortbox:checked ~ #sortboxmenu {
            opacity: 1;
        }
    </style>

    <title>@yield('title', 'MovieDeck | Best Movie Reviews')</title>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow">
        <div class="container px-10 py-6 mx-auto md:flex">
            <div class="flex items-center justify-between align-bottom">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-700 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                    </svg>
                    <a class="text-md font-bold uppercase text-gray-700 md:text-base hover:text-gray-600" href="{{ route('home') }}">Moviedeck</a>
                </div>
                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600" aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div class="w-full md:ml-28 md:flex md:items-center md:justify-between">
                <div class="flex flex-col px-2 py-3 -mx-4 md:flex-row md:mx-0 md:py-0">
                    <a href="{{ route('movies.index') }}" class="px-2 py-1 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded hover:bg-gray-900 hover:text-gray-100 md:mx-2">Movies</a>
                    <a href="{{ route('celebs.index') }}" class="px-2 py-1 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded hover:bg-gray-900 hover:text-gray-100 md:mx-2">Celebs</a>
                    <a href="{{ route('reviews.index') }}" class="px-2 py-1 text-sm font-medium text-gray-700 transition-colors duration-200 transform rounded hover:bg-gray-900 hover:text-gray-100 md:mx-2">Reviews</a>
                </div>

                <div class="relative flex">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>

                    <input type="text" class="w-full py-3 pl-10 pr-4 text-gray-700 bg-white border border-gray-300 rounded-md focus:border-blue-500 focus:outline-none focus:ring" placeholder="Search">

                    @guest
                        <button type="button" onclick="document.location='{{ route("login") }}'" class="flex items-center ml-5 px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            <span class="mx-2 whitespace-nowrap">{{ __('Login') }}</span>
                        </button>
                    @else
                        <img class="object-cover ml-5 items-center rounded-full h-12 w-12" src="{{asset(auth()->user()->avatar)}}" alt="avatar">

                        <div class="relative ml-3 flex items-center">
                            <input type="checkbox" id="sortbox" class="hidden absolute">
                            <label for="sortbox" class="flex items-center space-x-1 cursor-pointer">
                                <span class="text-lg font-medium text-gray-600 whitespace-nowrap">{{ auth()->user()->name }}</span>
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </label>

                            <div id="sortboxmenu" class="absolute mt-1 right-1 top-full min-w-max shadow rounded opacity-0 bg-gray-300 border border-gray-400 transition delay-75 ease-in-out z-10">
                                <ul class="block text-right text-gray-900">
                                    <li><a href="{{ route('profile.dashboard', auth()->user()->id) }}" class="block px-3 py-2 hover:bg-gray-200">My Profile</a></li>
                                    <li>
                                        <button class="flex px-3 py-2 w-full hover:bg-gray-200">
                                            <span class="mx-2 block whitespace-nowrap">
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                                    @csrf
                                                </form>
                                            </span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-gray-700 mt-10 text-gray-300">
        <div class="container px-6 py-6 mx-auto">
            <div class="lg:flex">
                <div class="w-full lg:w-2/3">
                    <div class="px-6">
                        <div class="flex align-bottom items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                            </svg>
                            <a class="text-md font-bold uppercase text-gray-300 md:text-base hover:text-gray-400" href="#">Moviedeck</a>
                        </div>

                        <p class="max-w-md mt-2 text-gray-300">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, nisi! Id.</p>

                        <div class="flex mt-4 -mx-2">
                            <a href="#" class="mx-2 text-gray-300 hover:text-gray-400" aria-label="Linkden">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512">
                                    <path
                                        d="M444.17,32H70.28C49.85,32,32,46.7,32,66.89V441.61C32,461.91,49.85,480,70.28,480H444.06C464.6,480,480,461.79,480,441.61V66.89C480.12,46.7,464.6,32,444.17,32ZM170.87,405.43H106.69V205.88h64.18ZM141,175.54h-.46c-20.54,0-33.84-15.29-33.84-34.43,0-19.49,13.65-34.42,34.65-34.42s33.85,14.82,34.31,34.42C175.65,160.25,162.35,175.54,141,175.54ZM405.43,405.43H341.25V296.32c0-26.14-9.34-44-32.56-44-17.74,0-28.24,12-32.91,23.69-1.75,4.2-2.22,9.92-2.22,15.76V405.43H209.38V205.88h64.18v27.77c9.34-13.3,23.93-32.44,57.88-32.44,42.13,0,74,27.77,74,87.64Z"/>
                                </svg>
                            </a>

                            <a href="#" class="mx-2 text-gray-300 hover:text-gray-400" aria-label="Facebook">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512">
                                    <path
                                        d="M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z"/>
                                </svg>
                            </a>

                            <a href="#" class="mx-2 text-gray-300 hover:text-gray-400" aria-label="Twitter">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 512 512">
                                    <path
                                        d="M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 lg:flex-1">
                    <div class="grid grid-cols-2 gap-6 sm:grid-cols-2">

                        <div>
                            <h3 class="text-gray-300 font-medium uppercase">About</h3>
                            <a href="#" class="block mt-2 text-sm text-gray-400 hover:underline">Our Mission</a>
                            <a href="#" class="block mt-2 text-sm text-gray-400 hover:underline">Privacy Policy</a>
                            <a href="#" class="block mt-2 text-sm text-gray-400 hover:underline">Terms and Conditions</a>
                            <a href="#" class="block mt-2 text-sm text-gray-400 hover:underline">Support</a>
                        </div>

                        <div>
                            <h3 class="text-gray-300 uppercase font-medium">Contact</h3>
                            <span class="block mt-2 text-sm text-gray-400 hover:underline">+1 526 654 8965</span>
                            <span class="block mt-2 text-sm text-gray-400 hover:underline">example@email.com</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="h-px my-6 bg-gray-600 border-none">

            <div>
                <p class="text-center text-gray-500">© MovieDeck 2020 - All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>
