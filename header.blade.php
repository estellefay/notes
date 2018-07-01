@extends('layouts.app')
@section('content')
<ul>
    @guest
        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
        <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
    @else
        <li>
            <div><a href="#">{{ Auth::user()->name }}</a></div>
            <div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
@endsection