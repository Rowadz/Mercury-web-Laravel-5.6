@extends('layouts.app')

@section('content')
    <div class="ui grid container">
        <div class="sixteen wide column ">
            <div class="ui  ">
                <div class="content">
                    <div class="center aligned header"><h1>Login</h1></div>
                    <div class="description ui inverted segment">
                        <form method="POST" action="{{ route('login') }}" class="ui form  inverted ">
                            @csrf
                            <div class="field">
                                <label> E-Mail Address</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                       autofocus
                                       placeholder="Enter your email here">
                            </div>
                            <div class="field">
                                <label> Password</label>
                                <input id="password" type="password" name="password" required
                                       placeholder="Enter your password here">
                            </div>
                            <div class="inline field">
                                <input type="checkbox" name="remember" tabindex="0"
                                       class="hidden" {{ old('remember') ? 'checked' : '' }}>
                                <label>Remember Me</label>
                            </div>
                            <button type="submit" class="ui inverted teal  button">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>


            @if ($errors->has('email'))
                <div class="ui red message">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif


            @if ($errors->has('password'))
                <div class="ui red message">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif

        </div>
        <div class="sixteen wide column">
            <h3>Thank you for joining us</h3>
            <img src="{{ asset('images/pattren2.png') }}" alt="Login image" class="ui image fluid">
            {{--<a rel="nofollow" href="https://www.vecteezy.com" target="_blank">Free Vector Design by: www.Vecteezy.com</a>--}}
        </div>
    </div>









@endsection
