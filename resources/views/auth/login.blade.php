@extends('layouts.app')

@section('content')
    <login-component
            login-url="{{ route('login') }}"
            has-error="{{ ($errors->has('email') || $errors->has('password')) }}"
            register-url="{{ route('register') }}"
            email="{{ old('email') }}"
            csrf="{{ csrf_token() }}"
    ></login-component>
@endsection
