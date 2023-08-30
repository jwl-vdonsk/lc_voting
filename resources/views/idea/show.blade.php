<x-app-layout>
    <div>
        <a href="{{ $backUrl }}" class="flex items-center font-semibold hover:underline">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
            <span class="ml-2">All ideas (or back to chosen category with filters)</span>
        </a>
    </div>

    <livewire:idea-show
        :idea="$idea"
        :votesCount="$votesCount"
    />

    <div class="comments-container relative space-y-6 md:ml-22 pt-4 my-8 mt-1">

        <div class="comment-container relative bg-white rounded-xl flex mt-6">
            <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar"
                             class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full md:mx-4">
                    {{--                    <h4 class="text-xl font-semibold">--}}
                    {{--                        <a href="#" class="hover:underline">A random title can go here</a>--}}
                    {{--                    </h4>--}}
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus atque dolores ea eligendi
                        maxime.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2 ">
                            <div class="text-gray-900 font-bold">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div
                            x-data="{ isOpen: false }"
                            class="flex items-center space-x-2 "
                        >
                            <button
                                @click="isOpen = !isOpen"
                                class="relative border bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                </svg>
                                <ul
                                    x-cloak
                                    x-show.transition.origin.top.left="isOpen"
                                    @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl
                                           z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                >
                                    <li><a href="#"
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in text-red">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment container -->

        <div class="is-admin comment-container relative bg-white rounded-xl flex mt-6">
            <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
                <div class="md:flex-none">
                    <div>
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar"
                                 class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="md:text-center uppercase text-xxs font-bold text-blue mt-1">Admin</div>
                </div>
                <div class="w-full md:mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">Status changed to "Under consideration"</a>
                    </h4>
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus atque dolores ea eligendi
                        maxime.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2 ">
                            <div class="text-blue font-bold">Andrea</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div
                            x-data="{ isOpen: false }"
                            class="flex items-center space-x-2 "
                        >
                            <button
                                @click="isOpen = !isOpen"
                                class="relative border bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                </svg>
                                <ul
                                    x-cloak
                                    x-show.transition.origin.top.left="isOpen"
                                    @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8 text-left z-10"
                                >
                                    <li><a href="#"
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in text-red">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment container -->

        <div class="comment-container relative bg-white rounded-xl flex mt-6">
            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=4" alt="avatar"
                             class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full mx-4">
                    {{--                    <h4 class="text-xl font-semibold">--}}
                    {{--                        <a href="#" class="hover:underline">A random title can go here</a>--}}
                    {{--                    </h4>--}}
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus atque dolores ea eligendi
                        maxime.
                    </div>
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2 ">
                            <div class="text-gray-900 font-bold">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                        </div>
                        <div class="flex items-center space-x-2 ">
                            <button
                                class="relative border bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                </svg>
                                <ul class="absolute w-44 font-semibold bg-white shadow-dialog rounded-xl py-3 ml-8 text-left hidden">
                                    <li><a href="#"
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in text-red">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end comment container -->

    </div> <!-- end comments container -->

</x-app-layout>
