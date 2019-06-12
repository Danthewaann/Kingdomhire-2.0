@extends('layouts.email')

@section('content')
<div class="contact-us-email">
    <div class="navbar-header public-navbar-header">
        <img class="logo" src="{{ $message->embed(public_path('/static/Kingdomhire_logo.png')) }}">
    </div>
    <h2>E-Mail Received</h2>
    <h5>Sent through Kingdomhire email form</h5>  
    <table class="table">
        <tbody>
            <tr>
                <th>Sent By</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th>E-Mail</th>
            <td><a class="text-link" href="mailto:{{ $email }}">{{ $email }}</a></td>
            </tr> 
        </tbody>        
    </table>
    <div class="email-content">
        <h2>E-Mail Content</h2>
        <hr>
        <p><b>Subject:</b> {{ $subject }}</p>
        <p><b>Message:</b><br>{!! $user_message !!}</p>
    </div>
    <hr>
    <a class="btn btn-lg btn-primary" role="button" href="mailto:{{ $email }}">Reply to {{ $name }}</a>
    <hr>
    <p>&copy; {{ date('Y') }} <a class="no-link">kingdomhire.com</a></p>    
</div>
@endsection