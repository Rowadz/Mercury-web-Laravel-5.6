{{-- @foreach($posts as $post)
<div class="myCard card ">
   <div class="image">
      @foreach($post->postImages as $image)
      <div>
         <div class="ui active dimmer imageLoader{{$image->id}}">
            <div class="ui indeterminate text loader ">Fetching Images</div>
         </div>
         <img class="ui  image" src="{{$image->location}}" onerror="brokenImageHandling(this, {{$image->id}})" 
            onload="removeSpecificLoader({{$image->id}})" 
            onabort="removeSpecificLoader({{$image->id}})" >
      </div>
      @break
      @endforeach
   </div>
   <div class="content">
      <div class="header">{{ $post->header }}</div>
      <div class="meta">
         @if($post->tag_id === 1)
         <a class="ui red right ribbon label" rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 2)
         <a class="ui teal right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 3)
         <a class="ui orange right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 4)
         <a class="ui yellow right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 5)
         <a class="ui green right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 6)
         <a class="ui blue right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 7)
         <a class="ui violet right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @elseif($post->tag_id === 8)
         <a class="ui black right ribbon label " rel="noreferrer">
         {{ $post->tag->name }}
         </a>
         @endif
      </div>
      <div class="description">
         <h4 style="color: #2e3436;">{{ $post->user->name }} says : </h4>
         <p>
            @if(strlen($post->body) >= 1400)
            {{ substr($post->body , 1400)}}
            @else
            {{ substr($post->body, 100) }}
            @endif
            <a href="/show/post/{{$post->id}}" rel="noreferrer" target="_blank"
               class="continueReadingATag">CONTINUE READING....👁️</a>
         </p>
      </div>
   </div>
   <div class="extra content">
      <span class="right floated">
      {{  $post->created_at->diffForHumans() }}
      </span>
      <span>
      💬 {{ sizeof($post->comments) }}
      </span>
   </div>
</div>
@endforeach
--}}

              @foreach($posts as $post)
              <div class="col s12 m4 ">
                 <div class="card  cyan darken-3 customShadow z-depth-5 ">
                    <div class="row">
                       <div class="col s12 m12 right-align">
                          <div class="chip z-depth-5 tagChip" data-aos="zoom-in-up">
                             <a href="#!" class="right-align">
                             {{ $post->tag->name }}
                             </a>
                          </div>
                       </div>
                    </div>
                    <div class="card-image">
                       @foreach($post->postImages as $image)
                       {{-- 
                       <div class="ui active large centered inline loader green imageLoader"></div>
                       --}}
                       <!-- Each loader will have a uniqe class name and should be removed when the image loadeed or if there is an error  ! -->
                       <div class="progress imageLoader{{$image->id}}">
                          <div class="indeterminate"></div>
                       </div>
                       <img src="{{$image->location}}"  onerror="brokenImageHandling(this, {{$image->id}})" 
                          onload="removeSpecificLoader({{$image->id}})" 
                          onabort="removeSpecificLoader({{$image->id}})"  class="responsive-img z-depth-5" data-aos="zoom-in-left">
                       @break
                       @endforeach
                       <span class="card-title">
                       <strong class="chip strongChips grey darken-3 blue-text" data-aos="zoom-out-up">
                       {{ $post->header }}
                       </strong>   
                       </span>
                       <a class="btn-floating halfway-fab  waves-effect waves-teal blue-grey darken-4 z-depth-5"
                          href="/show/post/{{$post->id}}" target="_blank" rel="noreferrer" data-aos="fade-right" >
                       <i class="material-icons">free_breakfast</i>
                       </a>
                    </div>
                    <div class="card-content cyan lighten-3">
                       <div class="row">
                          <div class="col s12 m12">
                             <div class="chip z-depth-5 strongChips" data-aos="fade-down-left">
                                🐨 {{ $post->user->name }}
                             </div>
                             <div class="chip z-depth-5" data-aos="fade-down-right">
                                📅 {{  $post->created_at->diffForHumans() }} 
                             </div>
                             <div class="chip z-depth-5" data-aos="fade-up-left">
                                💬 {{ sizeof($post->comments) }}
                             </div>
                          </div>
                       </div>
                       <p class="flow-text truncate">
                          {{ $post->body }}
                       </p>
                    </div>
                 </div>
              </div>
              @endforeach
         