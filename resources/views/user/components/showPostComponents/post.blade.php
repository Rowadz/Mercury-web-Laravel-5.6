<div class="ui segment">
        <input type="text" id="postId"   value="{{ $post->id }}" hidden>
        @if(isset(Auth()->user()->name))
            <input type="text" id="userName" value="{{ Auth()->user()->name }}" hidden>
        @endif
        @if(isset(Auth()->user()->image))
            <input type="text" id="userImage" value="{{ Auth()->user()->image }}" hidden>
        @endif
    <div class="ui feed" style="padding-left: 20px;">
        <div class="event">
            <div class="label">
                <img src="{{ $post->user->image }}">
            </div>
            <div class="content">
                <div class="date">
                    <a href="/@/{{ $post->user->name }}">
                        @guest
                        {{$post->user->name}}
                        @endguest
                        @auth
                        @if($post->user->name === Auth()->user()->name)
                            {{$post->user->name}} <span style="color:#ffa500">{ YOU }</span>
                        @else
                            {{$post->user->name}}
                        @endif
                        @endauth

                    </a>
                    <a class="ui tag label" style="float: right">{{ $post->tag->name }}</a>
                </div>
                <div class="summary">
                    {{$post->created_at->diffForHumans()}}
                </div>
            </div>
        </div>
    </div>

    <div class="ui relaxed stackable grid">
        <div class="three column row">
            @foreach($postImages as $image)
                <div class="column">
                    <img class="ui centered medium image"
                         src="{{ $image->location }}">
                </div>
            @endforeach
        </div>
    </div>
    <h1 class="postHeaderText">{{ $post->header }}</h1>
    <h4 class="ui horizontal divider header">
        <i class="clipboard icon"></i>
        Post Body
    </h4>
    @auth

    {{--<i class="bookmark outline icon wishListStar" @click="addPostToWishList({{ $post->id }})"></i>--}}
    @if($post->user->name !== Auth()->user()->name)
        @if($isWished)
            <div class="ui labeled button" tabindex="0">
                <div class="ui teal button">
                    <i class="bookmark icon"></i>
                </div>
                <a class="ui basic teal left pointing label" >
                    Already in your wish list
                </a>
            </div>
        @else
            <div class="ui labeled button" tabindex="0">
                <div class="ui orange button " id="addToWishListButton"
                     @click="addPostToWishList({{ $post->id }})">
                    <i class="bookmark outline icon"></i>
                </div>
                <a class="ui basic orange left pointing label" id="addToWishListText">
                    Add to wish list
                </a>
            </div>
        @endif
    @endif

    @endauth
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


    @endif


    <p class="postBodyText">
        {{ $post->body }}
    </p>
</div>