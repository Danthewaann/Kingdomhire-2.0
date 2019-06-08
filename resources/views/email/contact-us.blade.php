@extends('layouts.email')

@section('content')
<div class="contact-us-email">
    <div class="navbar-header public-navbar-header">
        <img class="logo" src="{{ $message->embed(public_path('/static/Kingdomhire_logo.png')) }}">
    </div>
    <h2>E-Mail Received</h2>
    <h5>Sent through Kingdomhire contact form</h5>  
    <table class="table">
        <tbody>
            <tr>
                <th>Sent By</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th>E-Mail</th>
            <td><a href="mailto:{{ $email }}">{{ $email }}</a></td>
            </tr> 
        </tbody>        
    </table>
    <div class="content">
        <h2>E-Mail Content</h2>
        <hr>
        <p>{!! $user_message !!}</p>
    </div>
    <hr>
    <p>&copy; {{ date('Y') }} <a class="no-link">kingdomhire.com</a></p>    
</div>
@endsection