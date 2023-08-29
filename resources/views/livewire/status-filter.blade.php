<div>
    <nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">

        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li><a wire:click.prevent="setStatus('All')"
                   href="#"
                   class="transition duration-150 ease-in border-b-4 pb-3 hover:border-blue @if ($status === 'All') border-blue text-gray-900 @endif"
                >All Ideas (87)</a>
            </li>
            <li><a wire:click.prevent="setStatus('Considering')"
                   href="#"
                   class="transition duration-150 ease-in border-b-4 pb-3 hover:border-purple @if ($status === 'Considering') border-purple text-gray-900 @endif"
                >Considering (6)</a>
            </li>
            <li><a wire:click.prevent="setStatus('In Progress')"
                   href="#"
                   class="transition duration-150 ease-in border-b-4 pb-3 hover:border-yellow @if ($status === 'In Progress') border-yellow text-gray-900 @endif"
                >In progress (1)</a>
            </li>
        </ul>

        <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
            <li><a wire:click.prevent="setStatus('Implemented')"
                   href="#"
                   class="transition duration-150 ease-in border-b-4 pb-3 hover:border-green @if ($status === 'Implemented') border-green text-gray-900 @endif"
                >Implemented (10)</a>
            </li>
            <li><a wire:click.prevent="setStatus('Closed')"
                   href="#"
                   class="transition duration-150 ease-in border-b-4 pb-3 hover:border-red @if ($status === 'Closed') border-red text-gray-900 @endif"
                >Closed (55)</a>
            </li>
        </ul>

    </nav>
</div>
