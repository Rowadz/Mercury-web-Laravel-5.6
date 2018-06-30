@foreach($posts as $post)
{{-- animated flipInX --}}
<div class="myCard card ">
    <div class="image">
        @foreach($post->postImages as $image)
            {{-- <div class="ui active large centered inline loader green imageLoader"></div> --}}
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
            <p>{{ substr($post->body ,1400)}}
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