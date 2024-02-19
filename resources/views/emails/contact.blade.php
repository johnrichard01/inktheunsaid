<x-mail::message>
Hello, you have a new message!

<h3>First Name: {{$data['firstName']}}</h3>
<h3>Last Name: {{$data['lastName']}}</h3>
<h3>Email Address: {{$data['email']}}</h3>
<h3>Message:{{$data['message']}}</h3>
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
