@extends('layouts.app')

@section('content')
<div class="container">

    <div>
        <h1 class="block-brand">
            <span>BRAIN</span>
            <span>FRAME</span>
            <span>RECALL</span>
        </h1>
        <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mg-neg">
            <div>
                <input class="main-input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span>
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <label for="email" class="main-label">E-Mail Address</label>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div>
                <input class="main-input"  id="password" type="password" name="password" required>
                @if ($errors->has('password'))
                    <span>
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <label for="password" class="main-label">Password</label>
        </div>

        <div>
            <div>
                <div class="flex-row">
                    <label class="fw-300">
                        <input class="fw-300" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>
        </div>

        <div>
            <div>
                <button type="submit" class="main-button pdd-lg hvr-bounce-to-right">
                    Login
                </button>

                <a href="{{ route('password.request') }}" class="fw-300">
                    Forgot Your Password?
                </a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection
