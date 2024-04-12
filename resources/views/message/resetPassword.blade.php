<x-mail::message>
<x-mail::panel>
    {{ __('words.hello') }} {{ $user->name }}
</x-mail::panel>

<p style="text-align: center">{{ __('words.messageClick') }}</p>

<x-mail::button :url="route('reset',$user->remember_token)">
    {{ __('words.resetYourPassword') }}
</x-mail::button>

<p style="text-align: center">{{ __('words.messageIssues') }}</p>

{{ __('words.thx')}}
{{ config('app.name') }}
</x-mail::message>

