@extends('layouts.master')
@section('title', 'Mercury | 🛰️')
{{--
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar --}}
@section('content')
<section class="registerSection" id="registerPage">
  <div id="particles-js" class="particles-js-register">
    <div class="row fixParticlesIssue">
      <div class="col s12 m12 ">
        <div class="container white-text flow-text  z-depth-5 hoverable mainResgister ">
          <h1 class="inputs greet">
            Welcome
          </h1>
          <div class="row">
            <div class="col s12 m12 inputs">
              <div class="col s12 m6 white-text" data-aos="fade-right">
                <a href="{{route('wlcome')}}" class="btn-floating btn-large waves-effect waves-light black hoverable tooltipped"
                  data-position="top" data-tooltip="Return">
                  <i class="material-icons deep-orange-text text-accent-4 ">home</i>
                </a>
                <a href="/login" class="btn-floating btn-large waves-effect waves-light black hoverable tooltipped"
                  data-position="top" data-tooltip="Login">
                  <i class="material-icons yellow-text text-accent-4">perm_identity</i>
                </a>
              </div>
              <div class="col s12 m6 white-text" data-aos="fade-left">
                <a class="waves-effect waves-light btn black z-depth-5 hoverable indigo-text text-accent-2">Facebook</a>
                <a class="waves-effect waves-light btn black z-depth-5 hoverable red-text text-accent-2">Google
                  +</a>
              </div>
            </div>
          </div>
          <div class="divider"></div>
          <div class="row  loginFormPadding">
            <div class="col s12 m12 white-text ">
              <form action="{{ route('register') }}" class="col s12" method="POST" id="registerForm">
                @csrf
                <div class="input-field col s12 m6" data-aos="flip-down">
                  <i class="material-icons prefix blue-text text-lighten-3">account_box</i>
                  <input id="name" type="text" class="validate white-text" required name='name' autofocus value={{ old('name') }}>
                  <label for="name">Name</label>
                  <span class="helper-text white-text">Should be unique</span>
                </div>
                <div class="input-field col s12 m6" data-aos="flip-down">
                  <i class="material-icons prefix blue-text text-lighten-3">email</i>
                  <input id="email" type="email" class="validate white-text" value="{{ old('email') }}" required name='email'>
                  <label for="email">E-Mail address</label>
                  <span class="helper-text white-text">Should be unique</span>
                </div>
                <div class="input-field col s12 m6 " data-aos="flip-up">
                  <i class="material-icons prefix blue-text text-lighten-3">security</i>
                  <input id="password" type="password" class="validate white-text" required name="password">
                  <label for="password">Password</label>
                </div>
                <div class="input-field col s12 m6 " data-aos="flip-up">
                  <i class="material-icons prefix blue-text text-lighten-3">security</i>
                  <input id="password-confirm" type="password" class="validate white-text" required name="password_confirmation">
                  <label for="password-confirm">Password confirmation</label>
                  <span class="helper-text white-text" id="password-confirm-helper">Should be the same as the password</span>
                </div>
                <div class="input-field col s12 m6 fixingMatError">
                  <i class="material-icons prefix white-text">date_range</i>
                  <input type="text" class="datepicker white-text" name="dateOfBirth" id="date-of-birth" value="{{ old('dateOfBirth') }}">
                  <label for="date-of-birth">date of birth</label>
                </div>
                <div class="input-field col s12 m6" class="white-text">
                  <i class="material-icons prefix white-text">location_city</i>
                  <select id="city" name="city" required>
                    <option value="" disabled selected class="white-text">Choose your City</option>
                    <option value="0">Amman</option>
                    <option value="1">Zarqa</option>
                    <option value="2">Irbid</option>
                    <option value="3">Aqaba</option>
                    <option value="4">As-Salt</option>
                    <option value="5">Madaba</option>
                    <option value="6">Mafraq</option>
                    <option value="7">Jerash</option>
                    <option value="8">Ma'an</option>
                    <option value="9">Tafilah</option>
                    <option value="10">Karak</option>
                  </select>
                  <label for="city">City</label>
                </div>
                <div class="input-field col s12 m6 ">
                  <i class="material-icons prefix blue-text  white-text">phone</i>
                  <input id="phone" type="number" class="validate white-text" required name="phone" value="{{ old('phone') }}"
                    min="0">
                  <label for="phone">Phone number</label>
                </div>
                <div class="input-field col s12 m6 ">
                  <i class="material-icons prefix white-text">mode_edit</i>
                  <textarea id="about" name="about" class="materialize-textarea white-text"></textarea>
                  <label for="about">About You</label>
                </div>
                <button class="btn waves-effect waves-light z-depth-5 hoverable grey darken-3" type="submit" name="action"
                  id="registerButton"> {{ __('Register') }}
                  <i class="material-icons right">send</i>
                </button>
              </form>
            </div>
            <div class="col s12 m6 white-text inputs">
              <div class="col s12 m6">
                @if ($errors->has('name'))
                <div class="card-panel  red darken-3 " data-aos="zoom-out-up">
                  <span class="white-text">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                </div>
                @endif
              </div>
              <div class="col s12 m6">
                @if ($errors->has('email'))
                <div class="card-panel  red darken-3 " data-aos="zoom-out-up">
                  <span class="white-text">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                </div>
                @endif
              </div>
              <div class="col s12 m6">
                @if ($errors->has('password'))
                <div class="card-panel  red darken-3 " data-aos="zoom-out-up">
                  <span class="white-text">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                </div>
                @endif
              </div>
              <div class="col s12 m6">
                @if ($errors->has('dateOfBirth'))
                <div class="card-panel  red darken-3 " data-aos="zoom-out-up">
                  <span class="white-text">
                    <strong>{{ $errors->first('dateOfBirth') }}</strong>
                  </span>
                </div>
                @endif
              </div>
              <div class="col s12 m6">
                @if ($errors->has('image'))
                <div class="card-panel  red darken-3 " data-aos="zoom-out-up">
                  <span class="white-text">
                    <strong>{{ $errors->first('image') }}</strong>
                  </span>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
