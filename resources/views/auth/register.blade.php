@extends('layouts.app')

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
            <form method="POST" action="{{ route('register') }}" class="ui form inverted" enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label><span style="color:#ff6666">*</span> Name</label>
                    <input placeholder="First Name" id="name" type="text" name="name" value="{{ old('name') }}" autofocus required>
                </div>
                {{-- <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"> --}}



                <div class="field">
                    <label><span style="color:#ff6666">*</span> E-Mail Address</label>
                    <input id="email" type="email" value="{{ old('email') }}" name="email" placeholder="E-Mail Address"
                           required>
                </div>

                {{-- <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"> --}}


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
                           placeholder="Enter your phone here" required min="0"  value="{{ old('phone') }}">
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


@endsection
