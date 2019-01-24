@extends('layouts.master')
@section('title', 'Explore ☄️')

@section('content')
@navBar(['style' => 'blue darken-4 z-depth-5'])
@endnavBar
<div class="row">
  <div class="col s12">
    <div class="row">
      <div class="input-field col s12 m6 l6">
        <i class="material-icons prefix blue-text">textsms</i>
        <input type="text" id="moh-search" class="autocomplete white-text">
        <label for="moh-search">Search Posts</label>
      </div>
      <div class="input-field col s12 m6 l6">
        <button class="btn" id="moh-go">
          Search
        </button>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col s12 m4 l4 ">
    <ul class="collapsible popout z-depth-5">
      <li>
        <div class="collapsible-header"><i class="material-icons">filter_drama</i>Cars</div>
        <div class="collapsible-body">
          <div class="collection">
            <a href="#!" class="collection-item">Alvin</a>
            <a href="#!" class="collection-item active">Alvin</a>
            <a href="#!" class="collection-item">Alvin</a>
            <a href="#!" class="collection-item">Alvin</a>
          </div>
        </div>
      </li>
      <li>
        <div class="collapsible-header"><i class="material-icons">place</i>Food</div>
        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
      </li>
      <li>
        <div class="collapsible-header"><i class="material-icons">home</i>Home</div>
        <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
      </li>
    </ul>
  </div>
  <div class="col s12 m8 l8">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Card Title</span>
        <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.
        </p>
      </div>
      <div class="card-action">
        <a href="#">This is a link</a>
        <a href="#">This is a link</a>
      </div>
    </div>
  </div>
</div>
@endsection
