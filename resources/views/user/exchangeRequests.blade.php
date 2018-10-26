@extends('layouts.master')
@section('title' , 'Mercury | 🤝')
@section('content')
@navBar(['style' => 'blue-grey darken-4'])
@endnavBar
@if (sizeof($exchangeRequests))

<div class="fixed-action-btn">
  <a class="btn-floating btn-large  waves-effect waves-light grey darken-4 z-depth-5" id="scrollTop">
    <i class="large material-icons">arrow_upward</i>
  </a>
</div>

<span id="scrollTopFinalDest"></span>



<div class="row" id="exchangeRequestsPage">
  <div class="col s12 m4 l4">
    <ul class="collection with-header z-depth-5" data-aos="fade-up">
      <li class="collection-header">
        <h6>Options</h6>
      </li>
      <li class="collection-item">
        <div>Reverse sorting
          <a href="#!" class="secondary-content">
            <i class="material-icons black-text" id="exchangeRequestReverseSorting">compare_arrows</i>
          </a>
        </div>
      </li>
      <!--<li class="collection-item">
            <div>Get a specific post
               <a href="#!" class="secondary-content">
               <i class="material-icons black-text">my_location</i>
               </a>
            </div>
         </li> -->
    </ul>
    <!--<section id="searchForAPostExchangeRequestResult">

      </section> -->
  </div>
  <div class="col s12 m4 l4">
    <div class="row">
      <div class="card blue-grey darken-1 z-depth-5 pulse">
        <div class="card-content white-text">
          <span class="card-title">Attention !</span>
          <p>If accepted any request the page will refresh, So if you forgot the person name just go to your profile
            and see the requests you accepted</p>
        </div>
      </div>
    </div>
    <section id="exchangeRequestsDataSorting">
      @foreach ($exchangeRequests as $exchangeRequest)
      <div class="card z-depth-5 exchangeRequest" data-aos="flip-left" id="exchangeRequest-{{$exchangeRequest->id}}">
        <div class="card-image waves-effect waves-block waves-light">
          <img class="activator" src="{{$exchangeRequest->theOtherPost->postImages[0]->location}}">
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4">
            <small class="chip strongChips grey darken-3 blue-text z-depth-5">
              {{$exchangeRequest->theOtherPost->header}}
            </small>
            <span class="chip strongChips grey darken-4 yellow-text text-accent-1 z-depth-5">
              Sent @ {{$exchangeRequest->created_at}}
            </span>
            <p class="flow-text truncate">{{$exchangeRequest->theOtherPost->body}}</p>
            <i class="material-icons right">more_vert</i>
          </span>
          <p>
            <a href="/show/post/{{$exchangeRequest->theOtherPost->id}}" target="_blank" class="btn-floating btn-large deep-purple lighten-4 pulse waves-effect waves-purple">
              <i class="material-icons black-text">open_in_new</i>
            </a>
            <a class="btn-floating btn-large cyan lighten-4 pulse modal-trigger-custom waves-effect waves-red"
              data-exchange-request-id="{{$exchangeRequest->id}}" data-auth-user-post-id="{{$exchangeRequest->post->id}}"
              data-post-id="{{$exchangeRequest->theOtherPost->id}}">
              <i class="material-icons black-text pulse">settings</i>
            </a>
          </p>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4">Your post<i class="material-icons right">close</i></span>
          <div class="card z-depth-5">
            <div class="card-image">
              <img src="{{$exchangeRequest->post->postImages[0]->location}}">
              <span class="card-title">
                <small class="chip strongChips grey darken-4 blue-text z-depth-5">
                  {{$exchangeRequest->post->header}}
                </small>
              </span>
            </div>
            <div class="card-content">
              <p class="flow-text truncate">{{$exchangeRequest->post->body}}</p>
            </div>
            <div class="card-action">
              <a href="/show/post/{{$exchangeRequest->post->id}}" target="_blank">
                <i class="material-icons black-text">open_in_new</i>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <section id="httpAjaxData"></section>
    </section>
  </div>
</div>
<div class="row">
  <div class="col s12 m4 l4"></div>
  <div class="col s12 m4 l4">
    <a class="waves-effect waves-light btn btn-large black z-depth-5" id="exchangeRequestsLoadMoreButton">Load More</a>
  </div>
</div>
<div id="exchangeRequestsModalOptions" class="modal">
  <div class="modal-content">
    <h4>Exchange Request Options</h4>
    <p>
      <span class="red-text text-accent-3">*</span> If you accept the request the your post will be moved into the
      <span class="red-text text-accent-3"> archive </span>, and no one can send you a requests no more.
    </p>
    <p>
      <span class="red-text text-accent-3">*</span> Accepting the request will allow you and the other person to
      <span class="deep-purple-text text-darken-4">add reviews about each other</span>, which make you more
      <span class="light-blue-text text-darken-4"> valid</span> for future exchanges
    </p>
    <p>
      If You accepted the request you need then to speak with the other user to decide the place to meet
    </p>
    <button class="waves-effect waves-light btn floatRight green accent-3" id="acceptExchangeRequestButtonModal">
      <i class="material-icons right">check</i>
      Accept
    </button>
    <button class="waves-effect waves-light btn  deep-orange accent-3" id="deleteExchangeRequestButtonModal">
      <i class="material-icons right">close</i>
      Delete
    </button>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-purple btn-flat">Dismiss</a>
  </div>
</div>
@else
<div class="row">
  <div class="col s12 m4 l4"></div>
  <div class="col s12 m4 l4">
    <div class="card transparent z-depth-0">
      <div class="card-image">
        <img src="{{asset('images/sad.png')}}" alt="no data found" class="responsive-img" data-aos="fade-up"
          data-aos-anchor-placement="bottom-bottom">
        <p class="card-title black-text" data-aos="zoom-in-right"><span class="chip strongChips blue-grey darken-4 white-text">
            No Data found</span></p>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
