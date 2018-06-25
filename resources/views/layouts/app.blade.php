<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mercury') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css" >

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.1/dist/semantic.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('styles')
    <!-- The Icon -->
    <link  type="favicon.ico" href="{{ asset('images/main.png') }}">
    


</head>
<body>



    <div class="ui stackable  menu">
        <div class="item">
            <a href="{{ url('/') }}">
                 <i class="rocket black icon large" id="homePopUp" data-content="Go to the Landing page"></i>
                {{--<img src="{{ asset('images/main.ico') }}" alt="Main icon for nav bar"--}}
                     {{--id="homePopUp" data-content="Go to the Landing page" class="ui image mini">--}}
            </a>
        </div>
        <div class="item" id="sideMenuToggle">
          <i class="black list alternate icon large"  id="menuPopUp" data-content="Open a side  menu"></i>
            <a class="ui black circular label animated infinite tada"
               id="notificationMenu" data-content="Someone Followed you or sent you a messsage,
               or there is a exchange request sent to you">0</a>
            {{--<img src="{{ asset('images/menu.png') }}" alt="menu image" class="ui image mini" id="menuPopUp" data-content="Open a side  menu">--}}
        </div>
        @auth
            <div class="item">
               <a href="/@/{{Auth()->user()->name}}/" rel="noreferrer" style="color:#1b6d85" class="mainTitle">
                    😀 {{ Auth::user()->name }}
                </a>

            </div>
            @endauth
            <div class="right menu">
                <div class="ui right aligned category search item">
                    <div class="ui transparent icon input">
                        <input class="prompt" type="text" placeholder="Search..." id="searchPopUp" data-content="You can Search to find users and posts.">
                        <i class="search link icon"></i>
                        {{--<img src="{{ asset('images/search2.png') }}" alt="search image" class="ui image"--}}
                        {{--style="cursor: pointer">--}}
                    </div>
                    <div class="results">
                    </div>
                </div>





            </div>
    </div>
    <div class="ui sidebar inverted vertical menu left">
        @auth
        <a class="item" href="/home">
            <div class="ui red label hideToFixMenu"></div>
            <!--🏠--> <i class=" home icon large"></i> Home
        </a>
        <a class="item" href="/@/{{ Auth()->user()->name }}">
            <div class="ui teal label hideToFixMenu"></div>
            <!--🕶--> <i class="user icon large"></i> Profile
        </a>
        <a class="item" href="#!">
            <div class="ui red label">0</div>
            <!--💬--> <i class="comment icon large"></i>Chat
        </a>
        <a class="item" href="/show/follow-Requests">
            <div class="ui red label" id="followingRequestUpdate">0</div>
            <!--💬--> <i class="star icon large"></i>
            Following Requests
        </a>
        {{-- <a class="item" href="#!">
            <div class="ui red label">0</div>
            <!--📋 --> <i class="bullhorn icon large"></i> Your Posts
        </a> --}}
        {{--<a class="item" href="#!">--}}
            {{--🖼 Images--}}
        {{--</a>--}}
        <a class="item" href="#!">
            <div class="ui red label">0</div>
            <!--🏹--> <i class="handshake icon large"></i> Exchange request
        </a>
        <a class="item" href="/followers">
            <!--📑-->
                <div class="ui red label">{{isset( $allFollowers )? $allFollowers : 0}}</div>
                <i class="users icon large"></i> Followers
        </a>

        <a class="item" href="#!">
           <!-- 🔦  -->
            <div class="ui red label">
                {{isset($allFollowedByTheUser)? $allFollowedByTheUser : 0}}
            </div>
            <i class="users icon large"></i> People you are following
        </a>
        <a class="item" href="/user/show-wished-posts">
            <div class="ui red label">
                {{ isset($wishes) ? $wishes : 0 }}
            </div>
            <!--🌠--> <i class="bookmark icon large"></i> Wish List
        </a>
        <a class="item" href="#!">
            <div class="ui red label hideToFixMenu">
            </div>
            <!--🌟--> <i class="tags icon large"></i> Explore Tags
        </a>
        <a class="item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="ui red label hideToFixMenu"></div>
            <!--🚪 --> <i class="sign out alternate icon large"></i> {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endauth
        @guest
        <a class="item" href="{{ route('login') }}">
            <div class="ui red label hideToFixMenu"></div>
            <i class="sign in alternate icon large"></i>{{ __('Login') }}
        </a>
        <a class="item" href="{{ route('register') }}">
            <div class="ui red label hideToFixMenu"></div>
            <i class="user circle icon large"></i>{{ __('Register') }}
        </a>
        <a class="item" href="/show/all/posts">
            <div class="ui red label hideToFixMenu"></div>
            <i class="images outline icon large"></i>See posts
        </a>
        @endguest
    </div>
    <div class="pusher">
            @yield('content')
    </div>



<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous" ></script>
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.3.1/dist/semantic.min.js" defer></script>
@yield('scripts')
<script src="{{ asset('js/app.js') }}" ></script>
@auth
    <input type="text" value="{{Auth()->user()->name}}"  id="userNameForCheckNewFollowers" hidden>
    {{-- <script src="{{ asset("js/checkForFollower.js") }}"></script> --}}
@endauth
</body>
</html>
