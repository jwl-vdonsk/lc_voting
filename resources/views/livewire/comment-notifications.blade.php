<div
    class="relative"
    x-data="{ isOpen: false}"
    wire:poll="getNotificationCount"
>
    <button @click="
        isOpen = !isOpen
        if (isOpen) {
            Livewire.emit('getNotifications')
        }
        ">
        <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-gray-400">
            <path fill-rule="evenodd"
                  d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                  clip-rule="evenodd"/>
        </svg>
        @if($notificationCount)
            <div
                class="absolute rounded-full bg-red text-white text-xxs w-5 h-5
            flex justify-center items-center top-0 right-0 border-2 -top-1 -right-1"
            >
                {{ $notificationCount }}
            </div>
        @endif
    </button>

    <ul
        class="absolute w-76 md:w-96 text-left text-sm text-gray-700 bg-white shadow-dialog
        rounded-xl max-h-96 z-10 overflow-y-auto -right-28 md:-right-12"
        x-cloak
        x-show.transition.origin.top="isOpen"
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
    >
        @if($notifications->isNotEmpty() && !$isLoading)
            @foreach($notifications as $notification)
                <li>
                    <a href="{{ route('idea.show', $notification->data['idea_slug']) }}"
                       @click.prevent="isOpen = false"
                       wire:click.prevent="markAsRead('{{ $notification->id }}')"
                       class="flex items-center hover:bg-gray-200 px-5 py-3 transition duration-150 ease-in">
                        <img src="{{ $notification->data['user_avatar'] }}"
                             class="rounded-xl w-10 h-10" alt="avatar">
                        <div class="ml-4">
                            <div class="line-clamp-4">
                                <span class="font-semibold">{{ $notification->data['user_name'] }}</span>
                                    commented on
                                <span class="font-semibold">{{ $notification->data['idea_title'] }}</span>:
                                <span>
                                    "{{ $notification->data['comment_body'] }}"
                                </span>
                            </div>
                            <div class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                </li>
            @endforeach
        <li class="border-t border-gray-300 text-center">
            <button
                wire:click="markAllAsRead"
                @click="isOpen = false"
                class="w-full block font-semibold hover:bg-gray-200 px-5 py-4 transition duration-150 ease-in">
                Mark all as read
            </button>
        </li>

        @elseif ($isLoading)  {{--skeleton loading --}}
            @foreach(range(1,3) as $item)
                <li class="animate-pulse flex items-center px-5 py-3 transition duration-150 ease-in">
                    <div class="bg-gray-200 rounded-xl w-10 h-10"></div>
                    <div class="ml-4 flex-1 space-y-1">
                        <div class="bg-gray-200 w-full rounded h-4"></div>
                        <div class="bg-gray-200 w-full rounded h-4"></div>
                        <div class="bg-gray-200 w-1/2 rounded h-4"></div>
                    </div>
                </li>
            @endforeach
        @else
            <div class="mx-auto w-40 py-6">
                <img src="{{ asset('img/no-ideas.svg') }}" alt="No ideas" class="mx-auto mix-blend-luminosity">
                <div class="text-gray-400 text-center font-bold mt-6">No new notifications</div>
            </div>
        @endif
    </ul>
</div>
