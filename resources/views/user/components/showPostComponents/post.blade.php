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
                    <div class="ui active inverted  dimmer imageLoader">
                            <div class="ui indeterminate text loader ">Fetching Image</div>
                    </div>
                <img src="{{ $post->user->image }}" 
                onerror="brokenImageHandling(this)" onload="removeLoader()" onabort="removeLoader()">
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
                        <div class="ui active inverted dimmer imageLoader{{$image->id}}">
                                <div class="ui indeterminate text loader ">Fetching Images</div>
                        </div>
                    <img class="ui centered medium image"
                         src="{{ $image->location }}" 
                         onerror="brokenImageHandling(this, {{$image->id}})" 
                    onload="removeSpecificLoader({{$image->id}})" 
                    onabort="removeSpecificLoader({{$image->id}})" >
                </div>
            @endforeach
        </div>
    </div>
    <h1 class="postHeaderText">{{ $post->header }}</h1>
    <h4 class="ui horizontal divider header">
        <i class="clipboard icon"></i>
        Post Body
    </h4>

    @options(['isWished' => $isWished, 'post' => $post])

    @endoptions

    <p class="postBodyText">
        {{ $post->body }}
    </p>
</div>