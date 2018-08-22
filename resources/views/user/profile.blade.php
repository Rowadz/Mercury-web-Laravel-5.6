@include('layouts.defaults')


@navBar(['style' => 'grey darken-4 z-depth-5'])
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
  <div class="col s12 m8">
     <div class="row">
        <div class="col s12 m12  orange-text text-darken-4">
           <h3>posts</h3>
           <div class="divider"></div>
        </div>
     </div>
     <div class="row">
      @displayPosts(['posts' => (isset($posts)) ? $posts : null, 'sm' => 's12 m6', "profile" => true])

      @enddisplayPosts
     </div>
     

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