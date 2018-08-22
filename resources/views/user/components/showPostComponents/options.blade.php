<div class="row">
    
    <div class="col s6 m3" data-aos="fade-down-left">
            <a class="waves-effect waves-light btn tooltipped purple darken-1"
                data-position="bottom" data-tooltip="Quantity: {{ $post->quantity }}"><i class="material-icons left"
               >widgets</i>
               {{ $post->quantity }}
            </a>
         </div>
    
    
        <div class="col s6 m3" data-aos="fade-down-left">
           <a class="waves-effect waves-light btn tooltipped blue darken-1"
            data-position="bottom" data-tooltip="Location: {{$post->location}}"><i class="material-icons left"
              >location_on</i>
                {{ $post->location }}
           </a>
        </div>
        @if(isset($post->video_link))
        <div class="col s6 m3 infoButtonPadding" data-aos="flip-right">
           <a class="waves-effect waves-light btn tooltipped red darken-1 "
              data-position="bottom" data-tooltip="There is a video of this item" target="_blank"
              href="{{ $post->video_link }}"><i class="material-icons left"
              >ondemand_video</i>
                Video
           </a>
        </div>
        @endif
</div>

{{--<i class="bookmark outline icon wishListStar" @click="addPostToWishList({{ $post->id }})"></i>--}}
{{-- @auth


@if($post->user->name !== Auth()->user()->name)
    @if($isWished)
        <div class="ui labeled button" tabindex="0" 
        data-title="Saved!" data-content="You Saved The Post"  id="alreadyInYourWishList">
            <div class="ui teal button">
                <i class="bookmark icon"></i>
            </div>
            <a class="ui basic teal left pointing label" >
                Already in your wish list
            </a>
        </div>
    @else
        <div class="ui labeled button" tabindex="0"
        data-title="Save the post" data-content="Click on the bookmark icon so save this post" id="addToWishList">
            <div class="ui orange button " id="addToWishListButton"
                 @click="addPostToWishList({{ $post->id }})">
                <i class="bookmark outline icon"></i>
            </div>
            <a class="ui basic orange left pointing label" id="addToWishListText">
                Add to wish list
            </a>
        </div>
    @endif
    @if(Auth()->user()->id !== $post->user_id)
    
            <div class="ui labeled button" tabindex="0"
            data-title="Exchange Request" data-content="Click Here to send an exchange request" id="exchangeRequest">
                <div class="ui brown button">
                    <i class="handshake icon"></i>
                </div>
                <a class="ui basic brown left pointing label">
                    Send Exchange Request
                </a>
            </div>

    @endif
@endif
@endauth --}}
{{-- 
@if($post->quantity === 0)
    <div class="ui labeled button" tabindex="0"
    data-title="Quantity" data-content="The item Quantity" id="postQuantity">
        <div class="ui black button">
            <i class="box icon"></i>
        </div>
        <a class="ui basic black left pointing label" >
            {{ $post->quantity }}
        </a>
    </div> 
@else
    <div class="ui labeled button" tabindex="0"
    data-title="Quantity" data-content="The item Quantity" id="postQuantity">
        <div class="ui green button">
            <i class="boxes icon"></i>
        </div>
        <a class="ui basic green left pointing label" >
            {{ $post->quantity }}
        </a>
    </div>
@endif

<div class="ui labeled button" tabindex="0"
data-title="Location" data-content="The Location you might meet" id="location">
    <div class="ui yellow button">
        <i class="map marker alternate icon"></i>
    </div>
    <a class="ui basic yellow left pointing label" >
        {{ $post->location }}
    </a>
</div>

@if(isset($post->video_link))
    <div class="ui labeled button" tabindex="0"
    data-title="YouTube Video" data-content="The Op provided a Video to the item" id="videoLink">
        <div class="ui purple button">
            <i class="youtube icon"></i>
        </div>
        <a class="ui basic purple left pointing label" href="{{ $post->video_link }}" target="_blank">
            There is a video for this Item !
        </a>
    </div>
@endif
@if($post->status === 0)
    <a class="ui red left corner label" id="postStatusIsZero"
       data-content="This means the post is archived!">
        <i class="archive  icon"></i>
    </a>
@else

    <a class="ui teal left corner label" id="postStatusIsOne" data-content="This means the post is still
    available ">
        <i class="flag checkered icon "></i>
    </a>
@endif --}}
