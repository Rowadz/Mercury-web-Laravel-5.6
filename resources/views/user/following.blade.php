@extends("layouts.app")

@section("content")
	<div class="ui grid container">
			<div class="ui link cards userFollowerCard" >
        @foreach($theFollowers as $following)
        
  <div class="card">
    <div class="image">
            <div class="ui active massive centered inline loader green imageLoader"></div>
      <img src="{{ $following->image }}" onabort="brokenImageHandling()" onerror="brokenImageHandling()"  onload="removeLoader()">
    </div>
    <div class="content">
      <div class="header">
      		<a href="/@/{{ $following->name }}">
      			{{ $following->name }}
      		</a>
      </div>
      <div class="meta">
        <a>You Are Following</a>
      </div>
      <div class="description">
        {{ substr($following->about, 10)}}
      </div>
    </div>
    <div class="extra content">
      <span class="right floated">
        	{{ $following->updated_at->diffForHumans() }}
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