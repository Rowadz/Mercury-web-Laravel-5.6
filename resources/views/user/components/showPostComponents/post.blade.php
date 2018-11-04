<!-- For the JavaScript -->
<input type="text" id="postId" value="{{ $post->id }}" hidden>
@if(isset(Auth()->user()->name))
<input type="text" id="userName" value="{{ Auth()->user()->name }}" hidden>
@endif
@if(isset(Auth()->user()->image))
<input type="text" id="userImage" value="{{ Auth()->user()->image }}" hidden>
@endif

<!-- Chips -->
<div class="row paddingTags">
  <div class="col s12 m4">
    <div class="chip z-depth-5 blue-grey darken-3" data-aos="fade-up-left">
      <img src="{{ $post->user->image }}" alt="Contact Person">
      <a href="/{{ $post->user->name }}">
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
  <div class="col s6 m2">
    <div class="chip z-depth-5 blue darken-4" data-aos="fade-right">
      <strong class="white-text">
        {{ $post->tag->name }}
      </strong>
    </div>
  </div>
  <div class="col s6 m2">
    <div class="chip z-depth-5 {{ ($post->status === 'available') ? "cyan" : "red"}} accent-4" data-aos="fade-left">
      <strong class="white-text">
        {{ ($post->status === 'available') ? "Available" : "Archived"}} 📦
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
  <div class="col s12 m12">
    <div class="card-panel grey darken-4" data-aos="fade-down-right">
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
</div>
</div class="row">
<div class="col s12 m9">
  <div class="card-panel grey darken-4 z-depth-5" data-aos="flip-down">
    <span class="white-text flow-text">
        {{ $post->body }}
      </span>
  </div>
</div>
</div>