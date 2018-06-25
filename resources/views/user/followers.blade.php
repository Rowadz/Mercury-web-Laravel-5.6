@extends("layouts.app")

@section("content")
	<div class="ui grid container">
			<div class="ui link cards userFollowerCard" >
		@foreach($Followers as $follower)
  <div class="card">
    <div class="image">
      <img src="{{ $follower->user->image }}">
    </div>
    <div class="content">
      <div class="header">
      		<a href="/@/{{ $follower->user->name }}">
      			{{ $follower->user->name }}
      		</a>
      </div>
      <div class="meta">
        <a>Following you</a>
      </div>
      <div class="description">
        {{ substr($follower->user->about, 10)}}
      </div>
    </div>
    <div class="extra content">
      <span class="right floated">
        	{{ $follower->updated_at->diffForHumans() }}
      </span>
      <span>
        <i class="user icon"></i>
      </span>
    </div>
  </div>
		@endforeach
</div>
	</div>
@endsection