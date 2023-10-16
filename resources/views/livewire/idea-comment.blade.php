<div
    id="comment-{{ $comment->id }}"
    class="
        @if ($comment->is_status_update) is-status-update {{ Str::kebab($comment->status->name) }} @endif
        comment-container relative bg-white rounded-xl flex transition duration-500 ease-in mt-6
    "
>
    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar"
                     class="w-14 h-14 rounded-xl">
            </a>
            @if ($comment->user->isAdmin())
                <div class="text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
            @endif
        </div>
        <div class="w-full md:mx-4">
            <div class="text-gray-600">
                @admin
                    @if ($comment->spam_reports > 0)
                        <div class="text-red mb-2"> Spam Reports: {{$comment->spam_reports}}</div>
                    @endif
                @endadmin
                @if ($comment->is_status_update)
                    <h4 class="text-xl font-semibold mb-3">
                        Status Changed to "{{ $comment->status->name }}"
                    </h4>
                @endif
                <div>
                    {{ $comment->body }}
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2 f">
                    <div class="@if ($comment->is_status_update) text-blue @endif font-bold text-gray-900">
                        {{ $comment->user->name }}
                    </div>
                    <div>&bull;</div>
                    @if ($comment->user->id === $ideaUserId)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <div>&bull;</div>
                    @endif
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>

                @auth
                    <div
                        x-data="{ isOpen: false }"
                        class="flex items-center space-x-2 text-gray-900"
                    >
                        <div class="relative">
                            <button
                                @click="isOpen = !isOpen"
                                class="relative border bg-gray-100 hover:bg-gray-200 rounded-full h-7 transition duration-150 ease-in px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
                                </svg>
                            </button>
                            <ul
                                x-cloak
                                x-show.transition.origin.top.left="isOpen"
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                                class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl
                                               z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                            >
                                @can('update', $comment)
                                    <li>
                                        <a href="#"
                                           @click.prevent="
                                                    isOpen = false
                                                    Livewire.emit('setEditComment', {{ $comment->id }})
                                                "
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in text-green">
                                            Edit Comment
                                        </a>
                                    </li>
                                @endcan

                                    <li>
                                        <a href="#"
                                           @click.prevent="
                                                isOpen = false
                                                Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                            "
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in">
                                            Mark as Spam
                                        </a>
                                    </li>

                                @admin
                                    @if ($comment->spam_reports > 0)
                                        <li>
                                            <a href="#"
                                               @click.prevent="
                                                    isOpen = false
                                                    Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                                "
                                               class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in">
                                                Mark as Not Spam
                                            </a>
                                        </li>
                                    @endif
                                @endadmin

                                @can('delete', $comment)
                                    <li>
                                        <a href="#"
                                           @click.prevent="
                                                isOpen = false
                                                Livewire.emit('setDeleteComment', {{ $comment->id }})
                                            "
                                           class="hover:bg-gray-200 block px-5 py-3 transition duration-150 ease-in text-red">
                                            Delete Comment
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</div>
