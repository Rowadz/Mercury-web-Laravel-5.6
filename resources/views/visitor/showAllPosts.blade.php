@extends('layouts.master')

@section('title', "Mercury | Visitor 👾")

@section('content')
<span id="scrollTopFinalDest"></span>
@navBar(['style' => 'grey darken-3 z-depth-5'])
@endnavBar
<span id="feedNoAuth"></span>
<div class="fixed-action-btn">
  <a class="btn-floating btn-large ndigo accent-1">
    <i class="large material-icons">dashboard</i>
  </a>
  <ul>
    <li id="scrollTop"><a class="btn-floating blue-grey lighten-1"> <i class="material-icons">arrow_upward</i></a></li>
  </ul>
</div>

<div id="feed">
  <div class="row">
    <div class="col s12 m4 l3"></div>
    @displayPosts(["posts" => $posts, "sm" => "s12 m4 l6"])

    @enddisplayPosts
    <input type="text" id="lastId" hidden value="{{ $posts[sizeof($posts) - 1]->id }}">
    <div class="col s12 m4 l3"></div>
  </div>
  <div class="row">
    <div class="col s12 m4 l3">
      <p></p>
    </div>

    @vuePosts(["sm" => "s12 m4 l6"])
    @endvuePosts

    <div class="col s12 m4 l3">
      <p></p>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection
