@extends('layouts.app')
@section('content')
<div>{{ __('Register') }}</div>
<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div>
            <label for="email">{{ __('E-Mail Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div>
            <label for="password-confirm"{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>
        <div>
            <button type="submit">{{ __('Register') }}</button>
        </div>
    </form>
</div>
@endsection