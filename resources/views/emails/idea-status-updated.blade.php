<x-mail::message>
# Idea Status Updated

The idea: {{ $idea->title }}
has been updated to a status of:
{{ $idea->status }}

<x-mail::button :url="'/'">
View Idea
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
