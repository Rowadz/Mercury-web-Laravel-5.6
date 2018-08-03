@include('layouts.defaults')

@navBar(['style' => 'grey darken-1 z-depth-5'])
@endnavBar

<section class="mainLogin ">
    <div class="VspaceLogin"></div>
    <div class="container white flow-text  z-depth-5 hoverable mainResgister">
       <h1 class="inputs greet" >
        Welcome
       </h1>
       <p class="inputs">You don't need to provide everything, <span class="blue-text text-lighten-3">blue</span>  is required </p>
       <div class="row  ">
          <div class="col s12 m12 inputs">
             <div class="col s6 m6 white-text" data-aos="fade-right">
                <a class="waves-effect waves-light btn indigo accent-2 z-depth-5 hoverable">Facebook</a>
             </div>
             <div class="col s6 m6 white-text" data-aos="fade-left">
                <a class="waves-effect waves-light btn red accent-2 z-depth-5 hoverable">Google +</a>
             </div>
          </div>
       </div>
       <div class="divider"></div>
       <div class="row  loginFormPadding">
          <div class="col s12 m6 white-text ">
            <form action="{{ route('register') }}" class="col s12" method="POST">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m12" data-aos="flip-down">
                       <i class="material-icons prefix blue-text text-lighten-3">account_box</i>
                       <input 
                             id = "name"
                             type = "text"
                             class = "validate"
                             required
                             name = 'name'
                             autofocus 
                             value = {{ old('name') }}
                             >
                       <label for="name">Name</label>
                       <span class="helper-text">Should be unique</span>
                    </div>
                 </div>
                <div class="row">
                   <div class="input-field col s12 m12" data-aos="flip-down">
                      <i class="material-icons prefix blue-text text-lighten-3">email</i>
                      <input 
                            id = "email"
                            type = "email"
                            class = "validate"
                            value="{{ old('email') }}"
                            required
                            name = 'email'
                            >
                      <label for="email">E-Mail Addredd</label>
                   </div>
                </div>
                <div class="row">
                   <div class="input-field col s12 m12 " data-aos="flip-up">
                      <i class="material-icons prefix blue-text text-lighten-3">security</i>
                      <input 
                            id = "password" 
                            type = "password" 
                            class = "validate"
                            required
                            name = "password"
                            >
                      <label for="password">Password</label>
                   </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 " data-aos="flip-up">
                       <i class="material-icons prefix blue-text text-lighten-3">security</i>
                       <input 
                             id = "password-confirm" 
                             type = "password" 
                             class = "validate"
                             required
                             name = "password_confirmation"
                             >
                       <label for="password-confirm">Password confirmation</label>
                       <span class="helper-text">Should be the same as the password</span>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 " >
                       <i class="material-icons prefix black-text">date_range</i>
                       <input 
                            type="text" 
                            class="datepicker" 
                            name="dateOfBirth"
                            id="date-of-birth"
                            value="{{ old('dateOfBirth') }}"
                            >
                       <label for="date-of-birth">date of birth</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12">
                            <i class="material-icons prefix blue-text text-lighten-3">location_city</i>

                            <select id="city" name="city" required>
                                    <option value="" disabled selected>Choose your City</option>
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
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 ">
                       <i class="material-icons prefix blue-text text-lighten-3">phone</i>
                       <input 
                             id = "phone" 
                             type = "number" 
                             class = "validate"
                             required
                             name = "phone"
                             value="{{ old('phone') }}"
                             min="0" 
                             >
                       <label for="phone">Phone number</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12 m12 " >
                        <i class="material-icons prefix black-text">mode_edit</i>
                        <textarea id="about" name="about" class="materialize-textarea"></textarea>
                        <label for="about">About You</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light z-depth-5 hoverable grey darken-3" type="submit" name="action"
                >  {{ __('Register') }}
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
 </section>


@include('layouts.defaultsBottom')
















{{-- 
@section('content')


    <div class="ui grid">
        <div class="eight wide computer column sixteen wide tablet">
            <div class="ui circular segment center aligned inverted ">
                <h2 class="ui header">Register Station</h2>
                <div class="sub header">it's free</div>
            </div>
            @if ($errors->has('name'))
                <div class="ui red message">
                    <strong>{{ $errors->first('name') }}</strong>
                </div>
            @endif
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
            @if($errors->has('dateOfBirth'))
                <div class="ui red message">
                    <strong>{{ $errors->first('dateOfBirth') }}</strong>
                </div>
            @endif
            @if($errors->has('image'))
                <div class="ui red message">
                    <strong>{{ $errors->first('image') }}</strong>
                </div>
            @endif
            <img src="{{ asset('images/monkey.svg') }}" alt="space monkey" class="ui image massive">
            <a rel="nofollow" href="https://www.Vecteezy.com/" target="_blank">Graphics Provided by Vecteezy.com</a>
        </div>
        <div class="eight wide computer column sixteen wide tablet">
            <div class="ui inverted segment">
                <h1><span style="color:#ff6666">*</span>Required</h1>
            <form method="POST" action="{{ route('register') }}" class="ui form inverted" 
            enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label><span style="color:#ff6666">*</span> Name</label>
                    <input placeholder="First Name" id="name" 
                    type="text" name="name" value="{{ old('name') }}" autofocus required>
                </div>
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">



                <div class="field">
                    <label><span style="color:#ff6666">*</span> E-Mail Address</label>
                    <input id="email" type="email" value="{{ old('email') }}" name="email" placeholder="E-Mail Address"
                           required>
                </div>

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">


                <div class="field">
                    <label><span style="color:#ff6666">*</span> Password</label>
                    <input id="password" type="password" name="password" required placeholder="Password">
                </div>



                <div class="field">
                    <label><span style="color:#ff6666">*</span> Confirm Password</label>
                    <input id="password-confirm" type="password" name="password_confirmation"
                           placeholder="Confirm Password" required>
                </div>


                <div class="field">
                    <label>Date of birth</label>
                    <input id="date-of-birth" type="date" name="dateOfBirth"
                           placeholder="Date Of birth" value="{{ old('dateOfBirth') }}">
                </div>

               <!-- <div class="field">
                    <label> Personal image</label>

                    <input id="image" type="file" name="image"
                           placeholder="Image" required hidden>
                    <button type="button" id="imageButton">Choose a file...</button>
                    <span id="imageText">No image chosen</span>
                </div>
                -->

                <div class="field">
                    <label><span style="color:#ff6666">*</span> City</label>
                    <select id="city" name="city" class="ui fluid dropdown" required >
                        <option value="">City</option>
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
                </div>

                <div class="field">
                    <label><span style="color:#ff6666">*</span> Phone number</label>
                    <input id="phone" type="number" name="phone"
                           placeholder="Enter your phone here" required min="0" 
                            value="{{ old('phone') }}">
                </div>
                <div class="field">
                    <label>About you</label>
                    <textarea placeholder="Write any thing about yourself" id="about" name="about">{{ old('about') }}</textarea>
                </div>
                <button type="submit" class="ui inverted yellow button" >
                    {{ __('Register') }}
                </button>


            </form>
            </div>
        </div>

    </div>


@endsection --}}
