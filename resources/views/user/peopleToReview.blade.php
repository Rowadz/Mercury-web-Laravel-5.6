@extends('layouts.master')

@section('title', 'Review')
@section("content")
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar
<section class="row" id="peopleToReviewSection">
  @forelse ($users as $user)
  <div class="col s12 m6 l6 offset-l3 offset-m3" data-divuser={{$user->user_id}}>
    <div class="card grey darken-3">
      <div class="card-content white-text">
        <span class="card-title">
          <div class="chip hoverable">
            {{-- <img src="{{ $user->image }}"> --}}
            <a href="/{{ $user->user_name }}">
              <strong class="black-text">{{ $user->user_name }}</strong>
            </a>
          </div>
          <button class="waves-effect waves-light btn floatRight grey darken-4 reviewButtonSubmit" data-addreviewtouser="{{$user->user_id}}"
            data-username="{{ $user->user_name }}">✅</button>
        </span>
        <section class="row">
          <div class="input-field col s12">
            <input id="reviewHeader" type="text" class="validate white-text" required data-inputHeader="{{$user->user_id}}">
            <label for="reviewHeader">Review header</label>
          </div>
          <div class="input-field col s12">
            <textarea id="inputbody" class="validate materialize-textarea white-text" required data-inputbody="{{ $user->user_id }}"></textarea>
            <label for="inputbody">What do you have to say</label>
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/happy.png')}}" alt="happy" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a happy face" data-usertoreview="{{$user->user_id}}" data-type="happy">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/angry.png')}}" alt="angry" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a angry face" data-usertoreview="{{$user->user_id}}" data-type="angry">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/sad.png')}}" alt="sad" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a sad face" data-usertoreview="{{$user->user_id}}" data-type="sad">
          </div>
        </section>
      </div>
    </div>
  </div>
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
</section>
@endsection
