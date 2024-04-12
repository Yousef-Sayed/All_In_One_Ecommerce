<x-mail::message>
<p style="text-align: center">{{ __('words.messageVerifyClick') }}</p>

<x-mail::button :url="route('admin.verified',$email)" color="success">
    {{ __('words.verifyEmailAddress') }}
</x-mail::button>

{{ __('words.thx')}}
{{ config('app.name') }}
</x-mail::message>

