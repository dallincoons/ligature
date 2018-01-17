@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex-col">
        <h1 class="block-brand">
            <span>BRAIN</span>
            <span>FRAME</span>
            <span>RECALL</span>
        </h1>

        <h3>Reset Password</h3>
        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control main-input" name="email" value="{{ old('email') }}" required>
                        <label for="email" class="main-label">E-Mail Address</label>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="main-button pdd-lg hvr-bounce-to-right">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection
