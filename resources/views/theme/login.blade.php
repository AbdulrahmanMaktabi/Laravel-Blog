@extends('theme.master')
@section('page-title', 'login page')
@section('hero', 'Login Page')

@section('content')
    @include('theme.partials.hero')
    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
                @if (session('welcome_msg'))
                    <div class="alert alert-success">
                        {{ session('welcome_msg') }}
                    </div>
                @endif
                <div class="col-6 mx-auto">
                    <form method="POST" action="{{ route('theme.login.post') }}" class="form-contact contact_form"
                        novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <input class="form-control border" name="email" id="email" type="email"
                                placeholder="Enter email address" value="{{ @old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <input class="form-control border" name="password" id="name" type="password"
                                placeholder="Enter your password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group text-center text-md-right mt-3">
                            <a class="button button--active button-contactForm" href="{{ route('theme.register') }}">
                                Register
                            </a>
                            <button type="submit" class="button button--active button-contactForm">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
@endsection
