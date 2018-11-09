@extends('layouts.master')

@section('title', 'Review')
@section("content")
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar
<section class="row" id="peopleToReviewSection">
  @forelse ($finalUsers as $user)
  @if ($user->user->id === Auth()->user()->id)
  <div class="col s12 m6 l6 offset-l3 offset-m3" data-divuser={{$user->onwer->id}}>
    <div class="card grey darken-3">
      <div class="card-content white-text">
        <span class="card-title">
          <div class="chip hoverable">
            <img src="{{ $user->onwer->image }}">
            <a href="/{{ $user->onwer->name }}">
              <strong class="black-text">{{ $user->onwer->name }}</strong>
            </a>
          </div>
          <button class="waves-effect waves-light btn floatRight grey darken-4 reviewButtonSubmit" data-addreviewtouser="{{$user->onwer->id}}"
            data-username="{{ $user->onwer->name }}">✅</button>
        </span>
        <section class="row">
          <div class="input-field col s12">
            <input id="reviewHeader" type="text" class="validate white-text" required data-inputHeader="{{$user->onwer->id}}">
            <label for="reviewHeader">Review header</label>
          </div>
          <div class="input-field col s12">
            <textarea id="inputbody" class="validate materialize-textarea white-text" required data-inputbody="{{ $user->onwer->id }}"></textarea>
            <label for="inputbody">What do you have to say</label>
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/happy.png')}}" alt="happy" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a happy face" data-usertoreview="{{$user->onwer->id}}" data-type="happy">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/angry.png')}}" alt="angry" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a angry face" data-usertoreview="{{$user->onwer->id}}" data-type="angry">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/sad.png')}}" alt="sad" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a sad face" data-usertoreview="{{$user->onwer->id}}" data-type="sad">
          </div>
        </section>
      </div>
    </div>
  </div>

  @else
  <div class="col s12 m6 l6 offset-l3 offset-m3" data-divuser={{$user->user->id}}>
    <div class="card grey darken-3">
      <div class="card-content white-text">
        <span class="card-title">
          <div class="chip hoverable">
            <img src="{{ $user->user->image }}">
            <a href="/{{ $user->user->name }}">
              <strong class="black-text">{{ $user->user->name }}</strong>
            </a>
          </div>
          <button class="waves-effect waves-light btn floatRight grey darken-4 reviewButtonSubmit" data-addreviewtouser="{{$user->user->id}}"
            data-username="{{ $user->user->name }}">✅</button>
        </span>
        <section class="row">
          <div class="input-field col s12">
            <input id="reviewHeader" type="text" class="validate white-text" required data-inputHeader="{{$user->user->id}}">
            <label for="reviewHeader">Review header</label>
          </div>
          <div class="input-field col s12">
            <textarea id="inputbody" class="validate materialize-textarea white-text" required data-inputbody="{{ $user->user->id }}"></textarea>
            <label for="inputbody">What do you have to say</label>
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/happy.png')}}" alt="happy" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a happy face" data-usertoreview="{{$user->user->id}}" data-type="happy">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/angry.png')}}" alt="angry" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a angry face" data-usertoreview="{{$user->user->id}}" data-type="angry">
          </div>
          <div class="col m4 l4 s4">
            <img src="{{asset('images/sad.png')}}" alt="sad" class="responsive-img emotionsReview tooltipped"
              data-position="bottom" data-tooltip="Give a sad face" data-usertoreview="{{$user->user->id}}" data-type="sad">
          </div>
        </section>
      </div>
    </div>
  </div>

  @endif
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
