@extends('layouts.master')
@section('title' , "Mercury | $user->name 🗿")
@section('content')
@navBar(['style' => 'grey darken-4 z-depth-5'])
@endnavBar

<div class="fixed-action-btn">
  <a class="btn-floating btn-large red">
    <i class="large material-icons">settings</i>
  </a>
  <ul>
    <li><a class="btn-floating red"><i class="material-icons">mode_edit</i></a></li>
    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
    <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  </ul>
</div>

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
      'following' => $following,
      'reviews' => $reviews
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
          <div class="card-panel grey darken-4 hoverable">
            <span class="white-text">
              @if ($followFeed->user->id === Auth()->user()->id)
              <i class="material-icons">group_add</i>
              {{ $followFeed->user->name }} has sent a follow request to {{ $followFeed->otherUser->name }}
              {{ $followFeed->created_at->diffForHumans() }}
              And was accepted ✔️ {{ $followFeed->updated_at->diffForHumans() }}
              {{-- @else
              🏹 {{ $user->name }} recived a follow request from {{ $followFeed->user->name }}
              {{ $followFeed->created_at->diffForHumans() }}
              And was accepted ✔️{{ $followFeed->updated_at->diffForHumans() }} --}}
              @endif
            </span>
          </div>
        </div>
        @empty
        <div class="col s12 m5">
          <div class="card-panel grey darken-4 hoverable">
            <span class="white-text">
              <i class="material-icons">group_add</i> {{ Auth()->user()->name }} has no following request activities
            </span>
          </div>
        </div>
        @endforelse
        @forelse ($exchangeRequests as $feed)
        <div class="col s12 m5 ">
          <div class="card-panel grey darken-4 hoverable">
            <span class="white-text">
              <i class="material-icons">mood</i> {{ $user->name }} had a ' successful ' exchange with
              <a href="/{{$feed->user->name}}"> {{ $feed->user->id === $user->id ? $feed->onwer->name :
                $feed->user->name}} </a> {{ $feed->created_at->diffForHumans() }}
            </span>
          </div>
        </div>
        @empty
        <div class="col s12 m5">
          <div class="card-panel grey darken-4 hoverable">
            <span class="white-text">
              🤝 {{ $user->name }} has no exchange request activities
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
