@extends('layouts.email')

@section('content')
<div class="contact-us-email">
    <div class="navbar-header public-navbar-header">
        <img class="logo" src="{{ $message->embed(public_path('/static/Kingdomhire_logo.png')) }}">
    </div>
    <table class="table">
        <tbody>
            <tr>
                <h2>E-Mail Received</h2>
                <h5>Sent through Kingdomhire email form</h5> 
            </tr>
            <tr>
                <th id="sent_by">Sent By</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th id="email">E-Mail</th>
                <td><a class="text-link" href="mailto:{{ $email }}?subject=Re: {{ rawurlencode($subject) }}">{{ $email }}</a></td>
            </tr> 
        </tbody>        
    </table>
    <table class="table">
        <tbody>
            <tr><th colspan="2" style="border-top: none; border-right: none;"><h2>E-Mail Content</h2></th></tr>
            <tr><th id="subject">Subject</th><td id="subject_td">{{ $subject }}</td></tr>
            <tr><th id="message">Message</th><td id="message_td">{!! $user_message !!}</td></tr>
            <tr>
                <td style="text-align: center; padding-top: 20px; padding-bottom: 20px" colspan="2">
                <a class="btn btn-lg btn-primary" role="button" href="mailto:{{ $email }}?subject=Re: {{ rawurlencode($subject) }}">Reply to {{ $name }}</a>
                </td>
            </tr>
            <tr><td style="text-align: center; padding-top: 50px" colspan="2">&copy; {{ date('Y') }} <a class="no-link">kingdomhire.com</a></td></tr>
        </tbody>
    </table>
</div>
@endsection