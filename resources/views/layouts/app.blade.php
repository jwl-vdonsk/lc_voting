<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns:livewire="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laracasts Voting</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

    <livewire:styles/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 text-sm bg-gray-background">
<header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
    <a href="/">
        <img src="{{ asset('img/logo-dark.svg') }}" alt="logo">
    </a>
    <div class="flex items-center mt-2 md:mt-0">
        @if (Route::has('login'))
            <div class="px-6 py-4">
                @auth
                    <div class="flex items-center space-x-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>

                        <div class="relative"
                             x-data="{ isOpen: false}"
                        >
                            <button @click="isOpen = !isOpen">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-gray-400">
                                    <path fill-rule="evenodd"
                                          d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <div
                                    class="absolute rounded-full bg-red text-white text-xxs w-5 h-5
                                    flex justify-center items-center top-0 right-0 border-2 -top-1 -right-1"
                                >
                                    4
                                </div>
                            </button>

                            <ul
                                class="absolute w-76 md:w-96 text-left text-sm text-gray-700 bg-white shadow-dialog
                                rounded-xl max-h-96 z-10 overflow-y-auto -right-28 md:-right-12"
                                x-cloak
                                x-show.transition.origin.top="isOpen"
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                            >

                                <li>
                                    <a href="#"
                                       @click.prevent="
                                                    isOpen = false
                                                "
                                       class="flex hover:bg-gray-200 px-5 py-3 transition duration-150 ease-in">
                                        <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50"
                                             class="rounded-xl w-10 h-10" alt="avatar">
                                        <div class="ml-4">
                                            <div class="line-clamp-4">
                                                <span class="font-semibold">John Doe</span>
                                                commented on
                                                <span class="font-semibold">This is my idea</span>:
                                                <span>
                                                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum facilis ipsam iusto numquam perspiciatis quae qui, sit voluptas voluptates voluptatibus."
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                       @click.prevent="
                                                    isOpen = false
                                                "
                                       class="flex hover:bg-gray-200 px-5 py-3 transition duration-150 ease-in">
                                        <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50"
                                             class="rounded-xl w-10 h-10" alt="avatar">
                                        <div class="ml-4">
                                            <div>
                                                <span class="font-semibold">John Doe</span>
                                                commented on
                                                <span class="font-semibold">This is my idea</span>:
                                                <span>
                                                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum facilis ipsam iusto numquam perspiciatis quae qui, sit voluptas voluptates voluptatibus."
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                       @click.prevent="
                                                    isOpen = false
                                                "
                                       class="flex hover:bg-gray-200 px-5 py-3 transition duration-150 ease-in">
                                        <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50"
                                             class="rounded-xl w-10 h-10" alt="avatar">
                                        <div class="ml-4">
                                            <div>
                                                <span class="font-semibold">John Doe</span>
                                                commented on
                                                <span class="font-semibold">This is my idea</span>:
                                                <span>
                                                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum facilis ipsam iusto numquam perspiciatis quae qui, sit voluptas voluptates voluptatibus."
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                       @click.prevent="
                                                    isOpen = false
                                                "
                                       class="flex hover:bg-gray-200 px-5 py-3 transition duration-150 ease-in">
                                        <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50"
                                             class="rounded-xl w-10 h-10" alt="avatar">
                                        <div class="ml-4">
                                            <div>
                                                <span class="font-semibold">John Doe</span>
                                                commented on
                                                <span class="font-semibold">This is my idea</span>:
                                                <span>
                                                    "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum facilis ipsam iusto numquam perspiciatis quae qui, sit voluptas voluptates voluptatibus."
                                                </span>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="border-t border-gray-300 text-center">
                                    <button
                                        class="w-full block font-semibold hover:bg-gray-200 px-5 py-4 transition duration-150 ease-in">
                                        Mark all as read
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <a href="#">
            <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp"
                 alt="avatar" class="w-10 h-10 rounded-full">
        </a>
    </div>
</header>
<main class="container mx-auto max-w-custom flex flex-col md:flex-row">
    <div class="w-70 mx-auto md:mx-0 md:mr-5">
        <div
            class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl mt-16"
            style="border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
            border-image-slice: 1;
            background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
            background-origin: border-box;
            background-clip: content-box, border-box;"
        >

            <div class="text-center px-6 py-2 pt-6">
                <h3 class="font-semibold text-base">Add an Idea</h3>
                <p class="text-xs mt-4">
                    @auth
                        Let us know what you would like and we`ll take a look over!
                    @else
                        Please login to create an idea.
                    @endauth
                </p>
            </div>

            @auth
                <livewire:create-idea/>
            @else
                <div class="my-6 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="inline-block items-center justify-center w-1/2 h-11 text-xs text-white bg-blue font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                    >Log in</a>

                    <a
                        href="{{ route('register') }}"
                        class="inline-block items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-3"
                    >Register</a>
                </div>
            @endauth

        </div>
    </div>
    <div class="w-full px-2 md:px-0 md:w-175">
        <livewire:status-filter/>
        <div class="mt-8">
            {{ $slot }}
        </div>
    </div>
</main>

@if (session('success_message'))
    <x-notification-success
        :redirect="true"
        message-to-display="{{ session('success_message') }}"
    />
@endif


<livewire:scripts/>
</body>
</html>
