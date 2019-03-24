@extends('layouts.app')

@section('content')
    <register-component
            register-url="{{ route('register') }}"
            has-email-error="{{ $errors->has('email') }}"
            has-password-error="{{ $errors->has('password') }}"
            password-error="{{ $errors->first('password') }}"
            email="{{ old('email') }}"
            csrf="{{ csrf_token() }}"
    ></register-component>
@endsection
