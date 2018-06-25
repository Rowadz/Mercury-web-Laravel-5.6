@extends("layouts.app")
@section("styles")
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/css/iziToast.min.css" />
@endsection
@section("content")
    <div class="ui grid" id="feed">
        <div class="row">
            <div class="myCardOnSmallScreens sixteen wide column ">
                <div class="ui link cards">
                    @foreach($wished as $wish)
                        <div class="myCard card animated flash" id="{{ $wish->id }}">
                            <div class="image">
                                @foreach($wish->post->postImages as $image)
                                    <img class="ui  image" src="{{$image->location}}">
                                    @break
                                @endforeach
                            </div>
                            <div class="content">
                                <div class="header">{{ $wish->post->header }}</div>
                                <div class="meta">
                                    @if($wish->post->tag_id === 1)
                                        <a class="ui red right ribbon label" rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id === 2)
                                        <a class="ui teal right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id=== 3)
                                        <a class="ui orange right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id === 4)
                                        <a class="ui yellow right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id === 5)
                                        <a class="ui green right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id === 6)
                                        <a class="ui blue right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id === 7)
                                        <a class="ui violet right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @elseif($wish->post->tag_id === 8)
                                        <a class="ui black right ribbon label " rel="noreferrer">
                                            {{ $wish->post->tag->name }}
                                        </a>
                                    @endif

                                </div>
                                <div class="description">
                                    <h4 style="color: #2e3436;">{{ $wish->post->user->name }} says : </h4>
                                    <p>{{ substr($wish->post->body ,1400)}}
                                        <a href="/show/post/{{$wish->post->id}}" rel="noreferrer" target="_blank"
                                           class="continueReadingATag">CONTINUE READING....👁️</a>
                                    </p>
                                </div>
                            </div>
                            <div class="extra content">
                                <span>
                                    💬 {{ sizeof($wish->post->comments) }}
                                </span>
                                <span class="right floated">

                                     📅  {{ $wish->post->created_at->diffForHumans() }}
                                </span>
                                <div class="ui horizontal divider">
                                    ℹ Info
                                </div>
                                <span>
                                      🎋 added to wish list
                                    {{  $wish->created_at->diffForHumans() }}
                                 </span>
                                <div class="ui horizontal divider">
                                    🖇Options
                                </div>
                                <button class="ui red circular icon button" onclick="deleteWish({{$wish->id }})">
                                    <i class="file excel outline icon"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/js/iziToast.min.js"></script>
    <script>
        function deleteWish(id){
            axios.post(`/user/delete-wished-post/${id}`, {
                id:id
            }).then(res => {
                $(`#${id}`).fadeOut()
                iziToast.success({
                    title: 'OK',
                    message: res.data.success
                })
            }).catch(() => {
                iziToast.error({
                    title: 'OK',
                    message: "Something went wrong!"
                })
            })
        }
    </script>
@endsection