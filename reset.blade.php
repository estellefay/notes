@extends('layouts.app')
@section('content')
<div>{{ __('Reset Password') }}</div>
<div>
    <form method="POST" action="{{ route('password.request') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
        </div>
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required>
        </div>
        <div>
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
        </div>
    </form>
</div>
@endsection