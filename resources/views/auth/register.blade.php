@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1 class="block-brand">
                    <span>BRAIN</span>
                    <span>FRAME</span>
                    <span>RECALL</span>
                </h1>
                <h2 class="panel-heading">Register</h2>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">


                            <div class="col-md-6">
                                <input id="name" type="text" class="main-input" name="name" value="{{ old('name') }}" required autofocus>
                                <label for="name" class="main-label">Name</label>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                            <div class="col-md-6">
                                <input id="email" type="email" class="main-input" name="email" value="{{ old('email') }}" required>
                                <label for="email" class="main-label">E-Mail Address</label>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                            <div class="col-md-6">
                                <input id="password" type="password" class="main-input"  name="password" required>
                                <label for="password" class="main-label">Password</label>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">


                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="main-input"  name="password_confirmation" required>
                                <label for="password-confirm" class="main-label">Confirm Password</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="main-button pdd-lg hvr-bounce-to-right">
                                    Sign me up!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
