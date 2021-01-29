@component('mail::message')
    Here is the link to delete the {{$details['name']}} profile you just created on Agegle
    @component('mail::button', ['url' => $details['url']])
        Delete Now
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
