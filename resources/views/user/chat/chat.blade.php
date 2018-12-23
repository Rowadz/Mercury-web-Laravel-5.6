@extends('layouts.master')

@section('title', 'Chat')
@section("content")
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar
<section class="row" id="chat">
  <div class="col s3 grey darken-1 h-100 overflowChatBox" id="scrollDisplayUsersHere">
    <div class="row" id="displayUsersHere">
      <div class="progress" id="loadingUsersNames">
        <div class="indeterminate"></div>
      </div>
    </div>
  </div>

  <div class="col s9 grey darken-2 h-100 overflowChatBox white-text">
    <div id="addMessagesHere">
    </div>        
  </div>
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">mode_edit</i>
          <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
          <label for="icon_prefix2">First Name</label>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection
