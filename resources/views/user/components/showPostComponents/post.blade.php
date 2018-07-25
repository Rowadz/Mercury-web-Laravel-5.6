<!-- For the JavaScript -->
<input type="text" id="postId"   value="{{ $post->id }}" hidden>
@if(isset(Auth()->user()->name))
    <input type="text" id="userName" value="{{ Auth()->user()->name }}" hidden>
@endif
@if(isset(Auth()->user()->image))
    <input type="text" id="userImage" value="{{ Auth()->user()->image }}" hidden>
@endif 

<!-- Chips -->
 <div class="row paddingTags">
    <div class="col s6 m2">
       <div class="chip z-depth-5 blue-grey darken-3" data-aos="fade-up-left">
          <img src="{{ $post->user->image }}" alt="Contact Person">
          <a href="/@/{{ $post->user->name }}">
          <strong>
                @guest
                    {{$post->user->name}} 🐼
                @endguest
                @auth
                    @if($post->user->name === Auth()->user()->name)
                        {{$post->user->name}} <span style="color:#ffa500">{ YOU }</span>
                    @else
                        {{$post->user->name}}
                    @endif
                @endauth
          </strong>

        </a>
       </div>
    </div>
    <div class="col s6 m2">
       <div class="chip z-depth-5 blue-grey" data-aos="fade-up-right">
          <strong>
          📆 {{$post->created_at->diffForHumans()}}
          </strong>
       </div>
    </div>
    {{-- <div class="col s6 m2">
       <div class="chip z-depth-5 deep-orange darken-4">
          <strong class="white-text">
          # of 💬
          </strong>
       </div>
    </div> --}}
<div class="col s6 m2">
       <div class="chip z-depth-5 blue darken-4" data-aos="fade-right">
          <strong class="white-text">
            {{ $post->tag->name }}
          </strong>
       </div>
    </div>
    <div class="col s6 m2">
       <div class="chip z-depth-5 {{ ($post->status === 0) ? "red" : "cyan"}} accent-4" data-aos="fade-left">
          <strong class="white-text">
            {{ ($post->status === 0) ? "Archived" : "Available"}} 📦
          </strong>
       </div>
    </div>
    
 </div>
 <!-- images -->
 <div class="row">
    @foreach($postImages as $image)
    <div class="col s12 m4" data-aos="fade-down">
        <img src="{{ $image->location }}" alt="item" class="responsive-img  postImage materialboxed">
    </div>
    @endforeach
 </div>


 <div class="row">
        <div class="col s12 m3">
           <div class="card-panel grey darken-4 z-depth-5 postHeader" data-aos="fade-down-right">
              <span class="white-text">
                 <h4>
                    <strong>
                            {{ $post->header }}
                    </strong>
                 </h4>
              </span>
           </div>
           @options(['isWished' => $isWished, 'post' => $post])

           @endoptions
       
        </div>
        <div class="col s12 m9">
           <div class="card-panel grey darken-4 z-depth-5 postBody" data-aos="flip-down">
              <span class="white-text flow-text">
                    {{ $post->body }}
              </sp4an>
           </div>
        </div>
</div>
{{-- 
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
</div> --}}