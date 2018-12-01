@extends('layouts.master')

@section('title', 'Chat')
@section("content")
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar
<div class="Vspace"></div>
<section class="container">
  <div class="row" id="chat" data-authuser="{{Auth()->user()->name}}" data-authuserid="{{Auth()->user()->id}}">
    <div class="col s12 m4 l3 holeScreen">
      @forelse ($users as $user)
      <ul class="collection clickable hoverable" data-user="{{$user->name}}">
        <li class="collection-item avatar">
          <img src="{{ $user->image }}" alt="" class="circle">
          <span class="title">{{ $user->name }}</span>
        </li>
      </ul>
      @empty
      <p>nothing</p>
      @endforelse
    </div>
    <div class="col s12 m8 l9">
      <!--  -->
      <div id="addMessagesHere">
      </div>
    </div>
  </div>
</section>
@endsection
