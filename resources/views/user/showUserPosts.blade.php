@extends('layouts.master')
@section('title', "Mercury | 📜 $user->name ")
@section('content')
@navBar(['style' => 'grey darken-4 z-depth-4'])
@endnavBar
<div class="row" id="sortPostsUserProfile">
  <div class="col s12 m6">
    <form action="/posts/{{$user->name}}/" method="GET" id="sortingForm">
      {{-- @csrf --}}
      <div class="input-field col s12">
        <select id="sortOption">
          <option value="" disabled selected class="white-text">Choose your option</option>
          <option value="Descending">Descending order Date</option>
          <option value="Ascending">Ascending order Date</option>
          <option value="comments">Number of comments</option>
        </select>
        <label>Via..</label>
      </div>
  </div>
  <div class="col s12 m6">
    <div class="input-field col s12">
      <select id="postsType">
        <option value="" disabled selected>Choose your option</option>
        <option value="Available">Available</option>
        <option value="Archived">Archived</option>
      </select>
      <label>Show</label>
    </div>
    <div class="input-field col s12">
      <button class="waves-effect waves-light btn" type="button" id="sortPostsUserProfileButton">
        Sort
      </button>
    </div>
    <input type="submit" value="" hidden>
  </div>
  </form>
</div>
<div class="row white-text">
  <h3>
    {{$sortType}} - {{$postsType}} posts
  </h3>
</div>
{{ $posts->links('user.components.helperComponents.pagination', ['posts' => $posts]) }}
<div class="row">
  <div class="col s12 m12">
    @displayPosts(['posts' => $posts, 'nextToEachOther' => true])
    @enddisplayPosts
  </div>
</div>
{{ $posts->links('user.components.helperComponents.pagination', ['posts' => $posts]) }}
