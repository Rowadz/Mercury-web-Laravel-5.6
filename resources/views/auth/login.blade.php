@extends('layouts.master')
@section('title', 'Mercury | 🚀')
{{-- @navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar --}}
@section('content')
<section class="mainLogin" id="loginPage">
    <div class="" id="particles-js">
        <!-- <div class="VspaceLogin"></div> -->
        <div class="row fixParticlesIssue">
            <div class="container  flow-text  z-depth-5 hoverable mainResgister ">
                <h1 class="inputs greet white-text">
                    Great to see you again!
                </h1>
                <div class="row">
                    <div class="col s12 m12 inputs">
                        <div class="col s12 m6 white-text" data-aos="fade-right">
                            <a href="{{route('wlcome')}}" class="btn-floating btn-large waves-effect waves-light black hoverable tooltipped"
                                data-position="top" data-tooltip="Return">
                                <i class="material-icons deep-orange-text text-accent-2">home</i>
                            </a>
                            <a href="/register" class="btn-floating btn-large waves-effect waves-light black hoverable tooltipped"
                                data-position="top" data-tooltip="register">
                                <i class="material-icons yellow-text text-accent-2">person_add</i>
                            </a>
                        </div>
                        <div class="col s12 m6 white-text" data-aos="fade-left">
                            <a class="waves-effect waves-light btn black indigo-text text-accent-2 z-depth-5 hoverable">Facebook</a>
                            <a class="waves-effect waves-light btn black red-text text-accent-2 z-depth-5 hoverable">Google+</a>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row  loginFormPadding">
                    <div class="col s12 m6 white-text ">
                        <form action="{{ route('login') }}" class="col s12 m12" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 m12" data-aos="flip-down">
                                    <i class="material-icons prefix white-text">email</i>
                                    <input id="email" type="email" class="validate white-text" value="{{ old('email') }}"
                                        required name='email' autofocus>
                                    <label for="email">E-Mail Addredd</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 m12 " data-aos="flip-up">
                                    <i class="material-icons prefix white-text">security</i>
                                    <input id="password" type="password" class="validate white-text" required name="password">
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <p data-aos="zoom-in-up">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <span>Remember me?</span>
                                </label>
                            </p>
                            <button class="btn waves-effect waves-light z-depth-5 hoverable grey darken-3 loginButton" type="submit"
                                name="action"> {{ __('Login') }}
                                <i class="material-icons right">weekend</i>
                            </button>
                            {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a> --}}
                        </form>
                    </div>
                    <div class="col s12 m6 white-text inputs">
                        @if ($errors->has('email'))
                        <div class="card-panel  red darken-3">
                            <span class="white-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        </div>
                        @endif
                        @if ($errors->has('password'))
                        <div class="card-panel  red darken-3">
                            <span class="white-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection