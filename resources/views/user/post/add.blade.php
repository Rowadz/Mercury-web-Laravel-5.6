@extends('layouts.master')
@section('title', "Create new Post")
@section('content')
@navBar(['style' => 'grey darken-3 z-depth-5'])
@endnavBar
<div class="Vspace"></div>
<div class="container" id="addPost">
  <div class="row cyan darken-3 bor z-depth-5">
    <h3 class="center-align animated flash">
      <i class="material-icons prefix small">subtitles</i>
      Adding a new post
      <i class="material-icons prefix small">subtitles</i>
    </h3>
    <form class="col s12" id="addPostForm">
      <div class="row">
        <div class="input-field col s12 animated bounceInDown">
          <i class="material-icons prefix">subject</i>
          <input id="header" type="text" class="validate white-text" name="header" required placeholder="header">
          <!-- <label for="header" class="white-text">Header</label> -->
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 animated bounceInDown">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="body" class="materialize-textarea validate white-text" name="body" required placeholder="write about your item"></textarea>
          <!--<label for="body">
            write about your item
          </label> -->
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 animated fadeInLeftBig">
          <i class="material-icons prefix">add_location</i>
          <input id="location" type="text" class="validate white-text" name="location" required placeholder="Location">
          <!-- <label for="location" class="white-text">Location</label>-->
        </div>
        <div class="input-field col s6 animated fadeInRightBig">
          <i class="material-icons prefix">layers</i>
          <input id="quantity" type="number" class="validate white-text" name="quantity" required placeholder="Quantity" min="1" max="100">
          <!-- <label for="quantity" class="white-text">Quantity</label> -->
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 animated slideInDown">
          <i class="material-icons prefix">videocam</i>
          <input id="videoLink" type="url" class="validate white-text" name="videoLink" placeholder="videoLink">
          <!-- <label for="videoLink" class="white-text">Video Link</label> -->
        </div>
        <div class="input-field col s6 animated slideInDown">
          <i class="material-icons prefix">image</i>
          <input id="image1" type="url" class="validate white-text" name="image1" required placeholder="Image link max 3">
          <!-- <label for="image1" class="white-text">Image link ~~max 3~~</label>-->
        </div>
      </div>
      <div id="addInputImages"></div>
      <div class="row">
        <div class="input-field col s16 animated slideInDown">
          <i class="material-icons prefix">local_offer</i>
          {{-- <select>
            <option value="" disabled selected>Tag</option> --}}
            <span id="addOptionsHere" hidden></span>
            {{-- <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option> --}}
            {{--
          </select> --}}
          {{-- <label>Choose a tag</label> --}}
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 animated slideInDown">
          <button id="addMoreImagesLinks" type="button" class="blue-grey darken-4 waves-effect waves-light btn z-depth-5">
            <i class="material-icons right">add</i>
            Add more images
          </button>
        </div>
        <div class="input-field col s6 animated slideInDown right-align">
          <button  id="submitAddPost" type="submit" class="blue-grey darken-4 waves-effect waves-light btn right-align z-depth-5" disabled>
              <i class="material-icons right">arrow_forward</i>
            Submit
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection
