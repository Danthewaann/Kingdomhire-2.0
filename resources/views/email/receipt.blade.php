@extends('layouts.email')

@section('content')
<div class="email-receipt">
    <div class="navbar-header public-navbar-header">
        <img class="logo" src="{{ $message->embed(public_path('/static/Kingdomhire_logo.png')) }}">
    </div>
    <table class="table">
        <tbody>
            <tr><th style="border-top: none; border-right: none;"><h2>E-Mail Receipt</h2></tr><th>
            <tr><td style="text-align: center">This is a copy of the email you sent us</tr></td>
        </tbody>
    </table>
    <table class="table">
        <tbody>
            <tr><th colspan="2" style="border-top: none; border-right: none;"><h2>E-Mail Content</h2></th></tr>
            <tr><th id="subject">Subject</th><td id="subject_td">{{ $subject }}</td></tr>
            <tr><th id="message">Message</th><td id="message_td">{!! $user_message !!}</td></tr>
            {{-- <tr><td colspan="2">{!! $user_message !!}</td></tr> --}}
            <tr><td style="text-align: center; padding-top: 50px" colspan="2">&copy; {{ date('Y') }} <a class="no-link">kingdomhire.com</a></td></tr>
        </tbody>
    </table>
    {{-- <div class="email-content">
        <h2>E-Mail Content</h2>
        <hr>
        <p><b>Subject:</b> {{ $subject }}</p>
        <p><b>Message:</b><br>{!! $user_message !!}</p>
    </div> --}}
    {{-- <hr> --}}
    {{-- <a class="btn btn-lg btn-primary" role="button" href="mailto:{{ $email }}">Reply to {{ $name }}</a> --}}
    {{-- <hr> --}}
    {{-- <p>&copy; {{ date('Y') }} <a class="no-link">kingdomhire.com</a></p>     --}}
</div>
@endsection