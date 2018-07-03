@extends('layouts.app')
@section('content')
<div>{{ __('Login') }}</div>
<div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div>
            <button type="submit">{{ __('Login') }}</button>
            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
        </div>
    </form>
</div>
@endsection
