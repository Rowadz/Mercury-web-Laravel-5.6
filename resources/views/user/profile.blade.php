@extends('layouts.master')
@section('title' , "Mercury | $user->name 🗿")
@section('content')
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar
<section id="profileWrapper">
  <div class="row">
    <div class="col s12 m12">
      <div class="parallax-container" id="profile">
        <div class="parallax"><img src="{{asset('images/coolBackgroundMain3.png')}}" class="responsive-img"></div>
      </div>
    </div>
  </div>
  <div class="row" id="feed">
    <div class="col s12 m4 addNigativeMarginToTop">
      @generalInfo([
      'user' => $user,
      'iamIFollowingThisUser' => $iamIFollowingThisUser,
      'followId' => $followId,
      'followers' => $followers,
      'following' => $following
      ])
      @endgeneralInfo
    </div>
    <div class="col s12 m8">
      <div class="row">
        <div class="col s12 m12  orange-text text-darken-4">
          <h3><b>Activities </b></h3>
          <div class="divider"></div>
        </div>
      </div>
      <div class="row">
        @forelse ($followingFeedProfile as $followFeed)
        {{ $followFeed['other_user'] }}
        <div class="col s12 m5 ">
          <div class="card-panel grey darken-4">
            <span class="white-text">

              @if ($followFeed->user->id === Auth()->user()->id)
              🏹 {{ $followFeed->user->name }} has sent a follow request to {{ $user->name }}
              {{ $followFeed->created_at->diffForHumans() }}
              And was accepted ✔️ {{ $followFeed->updated_at->diffForHumans() }}
              @else
              🏹 {{ $user->name }} recived a follow request from {{ $followFeed->user->name }}
              {{ $followFeed->created_at->diffForHumans() }}
              And was accepted ✔️{{ $followFeed->updated_at->diffForHumans() }}
              @endif
            </span>
          </div>
        </div>
        @empty
        <div class="col s12 m5">
          <div class="card-panel grey darken-4">
            <span class="white-text">
              🏹 {{ Auth()->user()->name }} has no following request activities
            </span>
          </div>
        </div>
        @endforelse
        @forelse ($exchangeRequests as $feed)


        <div class="col s12 m5 ">
          <div class="card-panel grey darken-4">
            <span class="white-text">
              🤝 {{ Auth()->user()->name }} has accepted to exchange <a href="/show/post/{{$feed->post->id}}">'
                {{$feed->post->header}} '</a>
              with {{ $feed->theOtherPost->user->name }}'s <a href="/show/post/{{$feed->theOtherPost->id}}"> '
                {{$feed->theOtherPost->header}} ' </a>
            </span>
          </div>
        </div>
        @empty
        <div class="col s12 m5">
          <div class="card-panel grey darken-4">
            <span class="white-text">
              🤝 {{ Auth()->user()->name }} has no exchange request activities
            </span>
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </div>
</section>
@endsection
@section('scripts')
@parent
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection
