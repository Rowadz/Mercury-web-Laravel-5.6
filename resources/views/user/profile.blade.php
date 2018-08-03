@include('layouts.defaults')


@navBar(
  [
      'style' => 'grey darken-4 z-depth-5',
  ]
  )
@endnavBar

<div class="row">
  <div class="col s12 m12">
    <div class="parallax-container" id="profile">
      <div class="parallax"><img src="{{asset('images/coolBackgroundMain3.png')}}" class="responsive-img" ></div>
    </div>
    
  </div>
</div>
<div class="row" id="feed">
  <div class="col s12 m4 addNigativeMarginToTop">
    {{-- {{ dd($user, $iamIFollowingThisUser, $followId) }} --}}
    @generalInfo([
      'user' => $user,
      'iamIFollowingThisUser' => $iamIFollowingThisUser,
      'followId' => $followId,
      'followers' => $followers,
      'following' => $following
      ])
    @endgeneralInfo
  </div>
  <div class="col s12 m8 ">
     <div class="row">
        <div class="col s12 m12 orange-text text-darken-4">
           <h3>posts</h3>
           <div class="divider"></div>
        </div>
     </div>
     
     @displayPosts(['posts' => (isset($posts)) ? $posts : null, 'sm' => 's12 m6'])

     @enddisplayPosts
     {{-- <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
     <input type="text" id="userIdProfile" hidden value="{{ $user->id }}">
     <!-- Loaded posts from ajax call -->
      @vuePosts()
      
      @endvuePosts --}}
  </div>
</div>

@extends('layouts.defaultsBottom')
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection







{{-- 



@extends("layouts.app")
@section("content")


<h4 class="ui horizontal divider header" id="profile">
  <i class="user icon"></i>
     {{ $user->name }} 
  <span class='orange'>
     {{(Auth()->user()->id === $user->id) ? "YOU" : ""}}
  </span>
</h4>

<!-- add aligned padded to center the text -->
<div class="ui stackable equal width center grid ">
  <div class="row">
      @generalInfo(['user' => $user, 'iamIFollowingThisUser' => $iamIFollowingThisUser, 'followId' => $followId])
      @endgeneralInfo
  </div>
  <h4 class="ui horizontal divider header">
      <i class="file alternate outline icon"></i>
      Recent 10 Posts
   </h4>


   <div class="row ">
      @recentPosts(['posts' => (isset($posts)) ? $posts : null])
      @endrecentPosts
   </div>
   <h4 class="ui horizontal divider header">
      <i class="trophy icon"></i>
      Achivements
   </h4>
   <div class="row">
      @achivements
      @endachivements
   </div>
</div>
@endsection

@section("scripts")
  {{-- <script src="{{ asset("js/profile.js") }}"></script> 
@endsection --}}