@extends('layouts.master')
@section('title', "$post->header")
@section('content')
<article id="postWrapper">
   @auth
   <div class="fixed-action-btn" data-aos="zoom-in">
      <a class="btn-floating btn-large optionsButton  amber darken-4 z-depth-5 tooltipped" data-position="left" 
         data-tooltip="Options">
      <i class="large material-icons">menu</i>
      </a>
      <ul id="postActionsWishUnWish">
         @if($post->user->name !== Auth()->user()->name)
         @if($isWished)
         <li id="deletePostFromWithListButton">
            <a class="btn-floating red tooltipped"  data-position="left" data-tooltip="Already Saved">
            <i class="material-icons">bookmark</i>
            </a>
         </li>
         @else
         <li id="addToWishListButton">
            <a class="btn-floating red tooltipped" data-position="left" data-tooltip="Click Here to add post to wish list">
            <i class="material-icons">bookmark_border</i>
            </a>
         </li>
         @endif
         @else
         <li>
            <a class="btn-floating  blue darken-3 tooltipped" data-position="left" data-tooltip="Your Post !">
            <i class="material-icons">tag_faces</i>
            </a>
         </li>
         <li>
            <a class="btn-floating yellow darken-2 tooltipped" data-position="left" data-tooltip="send Exchange Request">
            <i class="material-icons">forward</i>
            </a>
         </li>
         @endif
         <!-- Exchange Request -->
         @if(Auth()->user()->id !== $post->user_id && $post->status === 1)
         <li>
            <a class="btn-floating yellow darken-3 tooltipped modal-trigger" id="sendExchangeRequestTrigger" href="#sendExchangeRequestModal" data-position="left" data-tooltip="Send Exchange Request now">
            <i class="material-icons">pets</i>
            </a>
         </li>
         @endif
      </ul>
   </div>
   @endauth 
   @navBar(['style' => 'grey darken-3 z-depth-5'])
   @endnavBar
   <div id="{{ isset(Auth()->user()->id) ? 'post' : ''}}" >
      {{-- Load post here --}}
      @post(['post' => $post, 'postImages' => $postImages, 'isWished' => $isWished])
      @endpost    
      {{-- Load the comments here --}}
      @comments(['comments' => $comments, 'status' => $post->status])
      @endcomments
   </div>
   @sendExchangeRequest
   @endsendExchangeRequest
   <span id="showPostId" class="hideMe">{{$post->id}}</span>
</article>
@endsection