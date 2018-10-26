@extends('layouts.master')

@section('title', 'Mercury | 🌌')

@section('content')
<span id="scrollTopFinalDest"></span>
@navBar(['style' => 'grey darken-3 z-depth-5'])
@endnavBar

<div class="fixed-action-btn">
  <a class="btn-floating btn-large ndigo accent-1">
    <i class="large material-icons">dashboard</i>
  </a>
  <ul>
    <li id="scrollTop"><a class="btn-floating blue-grey lighten-1"> <i class="material-icons">arrow_upward</i></a></li>
    <li><a class="btn-floating blue darken-4"><i class="large material-icons">mode_edit</i></a></li>
    {{-- <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li> --}}
    {{-- <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li> --}}
  </ul>
</div>



<div id="feed">
  <div class="row">
    <div class="col s12 m6 l6">
      <section class="filters">
        <div class="card-panel teal">
          <span class="white-text">
            TODO :: add filter functions here
          </span>
        </div>
      </section>
    </div>
    <div class="col s12 m6 l6">
      @displayPosts(["posts" => $posts])
      @enddisplayPosts
    </div>
    <input type="text" id="lastId" hidden value="{{ sizeof($posts) ? $posts[sizeof($posts) - 1]->id : null }}">
    <!-- Loaded posts from ajax call -->
  </div>
  @if (sizeof($posts))
  <div class="row">
    <div class="">
      @vuePosts(["sm" => "s12 m6 l6"])
      @endvuePosts
    </div>
  </div>
  @else
  <div class="container">
    <div class="row center-align">
      <div class="col s12 m12 l12">
        <div class="card-panel red darken-3 z-depth-5">
          <span class="white-text">
            There is no data right now :(
          </span>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection
