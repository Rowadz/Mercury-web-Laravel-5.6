@extends('layouts.master')

@section('title', 'Review')
@section("content")
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar
@forelse ($finalUsers as $user)

<section class="row" id="peopleToReviewSection">
  <div class="col s12 m6 l6 offset-l3 offset-m3">
    <div class="card grey darken-3">
      <div class="card-content white-text">
        <span class="card-title">
          <div class="chip hoverable">
            <img src="{{ $user->image }}">
            <a href="/{{ $user->name }}">
              <strong class="black-text">{{ $user->name }}</strong>
            </a>
          </div>
        </span>
        <section class="row">
          <div class="col m4 l4 s4">
            <img src="{{asset('images/happy.png')}}" alt="happy" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a happy face" data-usertoreview="{{$user->id}}" data-type="happy">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/angry.png')}}" alt="angry" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a angry face" data-usertoreview="{{$user->id}}" data-type="angry">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/sad.png')}}" alt="sad" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a sad face" data-usertoreview="{{$user->id}}" data-type="sad">
          </div>
        </section>
      </div>
    </div>
  </div>
</section>
@empty
<section class="row">
  <div class="col s12 m6 l6 offset-m3 offset-l3">
    <div class="card-panel grey darken-3">
      <span class="white-text">
        <h1>
          No Data
        </h1>
      </span>
    </div>
  </div>
</section>
@endforelse

@endsection
