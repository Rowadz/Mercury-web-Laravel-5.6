@include('layouts.defaults')


@auth
<div class="fixed-action-btn" data-aos="zoom-in">
    <a class="btn-floating btn-large optionsButton  amber darken-4 z-depth-5 tooltipped" data-position="left" 
       data-tooltip="Options">
    <i class="large material-icons">menu</i>
    </a>
    <ul>
        @if($post->user->name !== Auth()->user()->name)
            @if($isWished)
                <li><a class="btn-floating red tooltipped"  data-position="left" data-tooltip="Already Saved"><i class="material-icons">bookmark</i></a></li>
            @else
                {{-- Can't bind Vue (@click) here  --}}
                <li  onclick="addPostToWishList({{ $post->id }})" id="addToWishListButton"><a class="btn-floating red tooltipped" data-position="left" data-tooltip="Click Here to add post to wish list"><i class="material-icons">bookmark_border</i></a></li>
            @endif
       @endif
       <!-- Exchange Request -->
       @if(Auth()->user()->id !== $post->user_id)
        <li><a class="btn-floating yellow darken-3 tooltipped" data-position="left" data-tooltip="Send Exchange Request now"><i class="material-icons">pets</i></a></li>
       @endif
    </ul>
</div>
@endauth 

 @navBarWelcome(
    [
        'style' => 'grey darken-3 z-depth-5'
    ]
    )
@endnavBarWelcome

    <div id="{{ isset(Auth()->user()->id) ? 'post' : ''}}" >
        {{-- Load post here --}}
        @post(['post' => $post, 'postImages' => $postImages, 'isWished' => $isWished])
        @endpost    
        {{-- Load the comments here --}}
        @comments(['comments' => $comments, 'status' => $post->status])
        @endcomments
    </div>


@extends('layouts.defaultsBottom')

@section("scripts")
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>--}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script> --}}
    @Auth
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    @endauth
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/js/iziToast.min.js"></script> --}}
@endsection
