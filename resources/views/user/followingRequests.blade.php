@extends("layouts.app")
@section("styles")
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/css/iziToast.min.css"/>
@endsection
@section("content")
<div class="ui grid container followRequestsPadding">
  <div class="ui cards">
    @foreach($followers as $follower)
    <div class="card" id="followCard{{ $follower->id }}">
      <div class="content">
        <img class="right floated mini ui image" src="{{ $follower->user->image }}">
        <div class="header">
          <a href="/@/{{ $follower->user->name }}">
            {{ $follower->user->name }}
          </a>
        </div>
        <div class="meta">
          {{ $follower->created_at->diffForHumans() }}
        </div>
        <div class="description">
          Sent you a follow Request!
        </div>
      </div>
      <div class="extra content">
        <div class="ui two buttons">
          <div class="ui  inverted green button" onclick="approve({{ $follower->id }})">Approve</div>
          <div class="ui  inverted red button" onclick="decline({{ $follower->id }})">Decline</div>
        </div>
      </div>
    </div>
	 @endforeach
  </div>
  <span id="followingRequests"></span>
</div>
@endsection

@section("scripts")
  {{-- <script src="{{ asset("js/approveDeclineFollow.js") }}"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/js/iziToast.min.js"></script>
@endsection