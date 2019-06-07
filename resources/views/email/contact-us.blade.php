
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="contact-us-email">
    <div class="jumotron jumbotron-nav">
        <div class="bg"></div>
        <div class="container">
            <div class="navbar-header public-navbar-header">
                <img class="logo" src="{{ asset('static/Kingdomhire_logo.svg') }}">
            </div>
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                <div class="panel panel-default" style="margin-top: 30px">
                    <div class="panel-heading">
                        <h2>E-Mail Received</h2>
                        <h5>Sent through Kingdomhire contact form</h5>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Sent By</th>
                            <td>{{ $name }}</td>
                        </tr>
                        <tr>
                            <th>E-Mail</th>
                            <td>{{ $email }}</td>
                        </tr>         
                    </table>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>E-Mail Content</h2>
                    </div>
                    <div class="panel-body">
                        {!! $user_message !!}
                    </div>
                </div>
            </div>
        </div>     
    </div>
    <div class="jumbtron jumbotron-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} kingdomhire.com</p>
        </div>
    </div>
</div>