<div class="contact-form">
    <h2>Email Form</h2>
    <hr>
    <form class="form-horizontal" action="{{ route('public.postContact') }}" method="post">
        @csrf
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-sm-3 control-label">Name*</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    {{ Form::text('name', '', array(
                    'class' => 'form-control', 'autocomplete' => 'off',
                    'placeholder' => 'Enter Name...', 'id' => 'name'))
                    }}
                </div>
                @if( $errors->has('name'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('name')])
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-sm-3 control-label">E-Mail*</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    {{ Form::email('email', '', array(
                    'class' => 'form-control', 'autocomplete' => 'off',
                    'placeholder' => 'Enter E-Mail...', 'id' => 'email'))
                    }}
                </div>
                @if( $errors->has('email'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('email')])
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
            <label for="message" class="col-sm-3 control-label">Message*</label>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-comment"></span></span>
                    {{ Form::textarea('message', '', array(
                        'class' => 'form-control', 'autocomplete' => 'off',
                        'placeholder' => 'Enter Message...', 'id' => 'message'))
                    }}
                </div>
                @if( $errors->has('message'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('message')])
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
            <div class="col-sm-9 col-sm-offset-3">
                {!! NoCaptcha::display(['data-size' => 'normal']) !!}
                @if( $errors->has('g-recaptcha-response'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('g-recaptcha-response')])
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-3">
                <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Submit</button>
            </div>
        </div>
    </form>
</div>