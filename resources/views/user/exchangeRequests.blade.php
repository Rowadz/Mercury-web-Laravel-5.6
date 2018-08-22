@include('layouts.defaults')
@navBar(['style' => 'blue-grey darken-4'])
@endnavBar
@if (sizeof($exchangeRequests))
<a class="btn-floating btn-large waves-effect waves-light   grey darken-4 z-depth-5" id="scrollTop"  data-aos="flip-left">
    <i class="material-icons">arrow_upward</i>
    </a>
    <span id="scrollTopFinalDest"></span>
<div class="row" id="exchangeRequestsPage">
   <div class="col s12 m4 l4">
      <ul class="collection with-header z-depth-5" data-aos="fade-up">
         <li class="collection-header">
            <h6>Options</h6>
         </li>
         <li class="collection-item">
            <div>Sort By Date
               <a href="#!" class="secondary-content">
               <i class="material-icons black-text">settings_input_composite</i>
               </a>
            </div>
         </li>
         <li class="collection-item">
            <div>Get a specific post
               <a href="#!" class="secondary-content">
               <i class="material-icons black-text">straighten</i>
               </a>
            </div>
         </li>
      </ul>
   </div>
   <div class="col s12 m4 l4">
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
               Sent  @ {{$exchangeRequest->created_at}}
               </span>
               <p class="flow-text truncate">{{$exchangeRequest->theOtherPost->body}}</p>
               <i class="material-icons right">more_vert</i>
            </span>
            <p>
               <a href="/show/post/{{$exchangeRequest->theOtherPost->id}}" target="_blank">
               <i class="material-icons black-text">open_in_new</i>
               </a>
               <a href="#exchangeRequestsModalOptions" class="modal-trigger">
               <i class="material-icons black-text">linear_scale</i>
               </a>
            </p>
         </div>
         <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Your post<i class="material-icons right">close</i></span>
            <div class="card">
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
      <section id="httpAjaxData"></section>
      @endforeach
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
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
   </div>
   <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
   </div>
</div>
@else 
<div class="row">
   <div class="col s12 m4 l4"></div>
   <div class="col s12 m4 l4">
      <div class="card transparent z-depth-0">
         <div class="card-image">
            <img src="{{asset('images/sad.png')}}" alt="no data found" class="responsive-img" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <p class="card-title black-text" data-aos="zoom-in-right"><span class="chip strongChips blue-grey darken-4 white-text"> No Data found</span></p>
         </div>
      </div>
   </div>
</div>
@endif
@include('layouts.defaultsBottom')