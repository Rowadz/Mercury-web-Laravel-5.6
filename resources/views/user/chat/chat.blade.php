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
      {{-- @forelse ($users as $user)
      <ul class="collection msgUser clickable hoverable mt-0" data-user="{{$user->name}}" data-image="{{$user->image}}">
        <li class="collection-item avatar grey darken-1">
          <img src="{{ $user->image }}" alt="" class="circle">
          <time class="title">{{ $user->name}}</time>
          <p>
            USER_MSG
          </p>
          <span class="new badge" data-badge-caption="custom caption">4</span>
        </li>
      </ul>
      @empty
      <ul class="collection msgUser clickable hoverable mt-0">
        <li class="collection-item avatar grey darken-1">
          <img src="{{ asset('images/happy.png') }}" alt="" class="circle">
          <p class="white-text">
            Someone is shy
          </p>
        </li>
      </ul>
      @endforelse --}}
      {{-- <div class="progress">
        <div class="indeterminate"></div>
      </div> --}}
    </div>
  </div>

  <div class="col s9 grey darken-2 h-100 overflowChatBox white-text">
    <div id="addMessagesHere">
    </div>
  </div>
</section>
@endsection
