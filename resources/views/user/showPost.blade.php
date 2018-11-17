@extends('layouts.master')
@section('title', "$post->header")
@section('content')
<article id="postWrapper" data-authuserid="{{ Auth()->user()->id }}">
  @auth
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large blue-grey darken-4 hoverable">
      <i class="large material-icons">menu</i>
    </a>
    <ul id="postActionsWishUnWish">
      @if($post->user->name !== Auth()->user()->name)
      @if($isWished)
      <li id="deletePostFromWithListButton">
        <a class="btn-floating red">
          <i class="material-icons">bookmark</i>
        </a>
      </li>
      @else
      <li id="addToWishListButton">
        <a class="btn-floating red">
          <i class="material-icons">bookmark_border</i>
        </a>
      </li>
      @endif
      @else
      <li>
        <a class="btn-floating  blue darken-3">
          <i class="material-icons">tag_faces</i>
        </a>
      </li>
      <li>
        <a class="btn-floating yellow darken-2">
          <i class="material-icons">forward</i>
        </a>
      </li>
      @endif
      <!-- Exchange Request -->
      @if(Auth()->user()->id !== $post->user_id && $post->status === 'available')
      <li>
        <a class="btn-floating light-blue darken-1 modal-trigger" id="sendExchangeRequestTrigger" href="#sendExchangeRequestModal">
          <i class="material-icons">extension</i>
        </a>
      </li>
      @endif
    </ul>
  </div>
  @endauth
  @navBar(['style' => 'grey darken-3 z-depth-5'])
  @endnavBar
  <div id="{{ isset(Auth()->user()->id) ? 'post' : ''}}" class="selectMeuseridpost" data-useridpost="{{ $post->user_id }}">
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
