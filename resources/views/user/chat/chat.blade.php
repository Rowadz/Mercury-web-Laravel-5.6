@extends('layouts.master')

@section('title', 'Chat')
@section("content")
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar

@modalNButton()
@endmodalNButton

<section class="row" id="chat">
  <div class="col m3 s12 grey darken-1 h-100 overflowChatBox" id="scrollDisplayUsersHere">
    <div class="row" id="displayUsersHere">
      <div class="progress" id="loadingUsersNames">
        <div class="indeterminate"></div>
      </div>
    </div>
  </div>

  <div class="col m9 s12 grey darken-2 h-100 overflowChatBox white-text" id="scrollDisplayMessagesHere">
    <div id="addMessagesHere">
    </div>
  </div>
</section>
@endsection
