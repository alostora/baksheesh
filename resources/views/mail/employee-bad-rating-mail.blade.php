@component('mail::message')
# Hello MR {{$mailData['client_name']}}

There is an employee in your company {{$mailData['company_name']}} his name is : <br>

<h4>{{$mailData['employee_name']}}</h4>

Has a bad review he got {{$mailData['rating_value']}} points of 5 points in {{$mailData['rating_name']}} field


@component('mail::button', ['url' => $mailData['url']])
Visit Our Website
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent