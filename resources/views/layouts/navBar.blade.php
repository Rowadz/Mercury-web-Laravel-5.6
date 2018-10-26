<nav class="{{isset($style) ? $style  : 'transparent  z-depth-0'}} fixed" data-aos="zoom-in">
  <div class="container">
    <div class="nav-wrapper">
      <!-- <a href="#!" class="brand-logo ">Logo</a> -->
      <a href="{{ url('/') }}" class="brand-logo">Mercury</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        @guest
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        <li><a href="{{route('search')}}"><i class="material-icons">search</i></a></li>
        @endguest
        @auth
        <li><a href="{{ route('profile', ['user' => Auth()->user()->name]) }}">
            <i class="large material-icons ">account_circle</i>
          </a>
        </li>
        <li><a href="{{ route('home') }}">
            <i class=" large material-icons">home</i>
          </a>
        </li>
        <li><a href="{{route('search')}}"><i class="material-icons">search</i></a></li>
        <li><a class="dropdown-trigger" href="#!" data-target="dropdownAuth"> <i class="material-icons">more_vert</i></a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
@guest
<ul class="sidenav" id="mobile-demo">
  <li><a href="{{route('search')}}"><i class="material-icons">search</i></a></li>
  <li><a href="{{ route('register') }}">Register</a></li>
  <li><a href="{{ route('login') }}">Login</a></li>
</ul>
@endguest
@auth
<!-- Dropdown Structure -->
<ul id="dropdownAuth" class="dropdown-content blue-grey lighten-5">
  <li>
    <a href="{{ route('openChat') }}" class="black-text">
      <i class="material-icons black-text">message</i>
      Chat
      <span class="new badge black white-text z-depth-5">+99</span>
    </a>
  </li>
  <li>
    <a href="#followRequestsModal" class="black-text modal-trigger">
      <i class="material-icons black-text ">person_add</i>
      Follow Requests
      <span class="new badge black white-text updateFollowRequestsNumber z-depth-5">{{
        isset($followRequestsCount) ? $followRequestsCount : 'zero' }}</span>
    </a>
  </li>
  <li>
    <a href="{{route('exchangeRequest')}}" class="black-text">
      <i class="material-icons black-text">room_service</i>
      Exchange Request
      <span class="new badge black white-text z-depth-5">{{$exchangeRequestCount ?: 0}}</span>
    </a>
  </li>
  <li>
    <a href="#followersModal" class="black-text modal-trigger followersModalTrigger">
      <i class="material-icons black-text">group</i>
      Followers
      <span class="badge black white-text z-depth-5 updateFollowersNumber" id="getFollowersNumber">{{isset(
        $allFollowers )? $allFollowers : 'zero'}}</span>
    </a>
  </li>
  <li>
    <a href="#followingModal" class="black-text modal-trigger peopleYouAreFollowingModalTrigger">
      <i class="material-icons black-text">group_work</i>
      People you are following
      <span class="badge black white-text z-depth-5" id="getpeopleYouAreFollowingNumber">{{isset($allFollowedByTheUser)?
        $allFollowedByTheUser : 'zero'}}</span>
    </a>
  </li>
  <li class="divider"></li>
  <li>
    <a href="#wishesModal" class="black-text modal-trigger wishesModalTrigger">
      <i class="material-icons black-text">stars</i>
      Wished Posts
      <span class="badge black white-text z-depth-5 updateWishesNumber" id="getWishesNumber"> {{
        isset($wishes) ? $wishes : 0 }} </span>
    </a>
  </li>
  <li>
    <a href="{{ route('review') }}" class="black-text pulse">
      <i class="material-icons black-text">face</i>
      People to Review
    </a>
  </li>
  <li class="divider"></li>
  <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <a href="{{ route('logout') }}" class="black-text">
      <i class="material-icons black-text">exit_to_app</i>
      {{ __('Logout') }}
    </a>
  </li>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
</ul>


<!-- Side nav -->
<ul id="dropdownAuthSideNav" class="dropdown-content">
  <li>
    <a href="{{ route('openChat') }}" class="black-text">
      <i class="material-icons black-text">message</i>
      Chat
      <span class="new badge black white-text z-depth-5">+99</span>
    </a>
  </li>
  <li>
    <a href="#followRequestsModal" class="black-text modal-trigger">
      <i class="material-icons black-text">person_add</i>
      Follow Requests
      <span class="new badge black white-text updateFollowRequestsNumber z-depth-5"> {{
        isset($followRequestsCount) ? $followRequestsCount : 'zero' }} </span>
    </a>
  </li>
  <li>
    <a href="{{route('exchangeRequest')}}" class="black-text">
      <i class="material-icons black-text">room_service</i>
      Exchange Request
      <span class="new badge black white-text z-depth-5">{{$exchangeRequestCount ?: 0}}</span>
    </a>
  </li>
  <li>
    <a href="#followersModal" class="black-text modal-trigger followersModalTrigger">
      <i class="material-icons black-text">group</i>
      Followers
      <span class="badge black white-text z-depth-5 updateFollowersNumber">{{isset( $allFollowers )?
        $allFollowers : 'zero'}}</span>
    </a>
  </li>
  <li>
    <a href="#followingModal" class="black-text modal-trigger peopleYouAreFollowingModalTrigger">
      <i class="material-icons black-text">group_work</i>
      People you are following
      <span class="badge black white-text z-depth-5">{{isset($allFollowedByTheUser)?
        $allFollowedByTheUser : 'zero'}}</span>
    </a>
  </li>
  <li class="divider"></li>
  <li>
    <a href="#wishesModal" class="black-text modal-trigger wishesModalTrigger">
      <i class="material-icons black-text">stars</i>
      Wished Posts
      <span class="badge black white-text z-depth-5 updateWishesNumber"> {{ isset($wishes) ? $wishes
        : 0 }} </span>
    </a>
  </li>
  <li>
    <a href="{{ route('review') }}" class="black-text pulse">
      <i class="material-icons black-text">face</i>
      People to Review
    </a>
  </li>
  <li class="divider"></li>
  <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <a href="{{ route('logout') }}" class="black-text">
      <i class="material-icons black-text">exit_to_app</i>
      {{ __('Logout') }}
    </a>
  </li>
</ul>
<ul class="sidenav" id="mobile-demo">
  <li><a href="{{ route('profile', ['user' => Auth()->user()->name]) }}">
      <i class="material-icons ">account_circle</i>
      Profile
    </a>
  </li>
  <li><a href="{{ route('home') }}">
      <i class=" material-icons">home</i>
      Home
    </a>
  </li>
  <li>
    <a href="{{route('search')}}">
      <i class="material-icons">search</i>
      Search
    </a>
  </li>
  <li><a class="dropdown-trigger" href="#!" data-target="dropdownAuthSideNav"> <i class="material-icons">more_vert</i></a></li>
</ul>
@endauth
