@component('mail::message')
the User name is : {{$details->name}}."<br>
the Email name is : {{$details->email}}."<br>
the Phone Number  is : {{$details->phone_number}}."<br>
Thanks, Ride App<br>
{{ config('app.name') }}
@endcomponent
