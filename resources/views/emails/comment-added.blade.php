<x-mail::message>
# A comment was posted on your idea

{{ $comment->user->name }} comment on your idea:

{{--{{ $comment->idea->title }}--}}

Comment: {{ $comment->body }}

<x-mail::button :url="'/'">
Go to Idea
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
