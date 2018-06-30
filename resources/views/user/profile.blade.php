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
  {{-- <script src="{{ asset("js/profile.js") }}"></script> --}}
@endsection