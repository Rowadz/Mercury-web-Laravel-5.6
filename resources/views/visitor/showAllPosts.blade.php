@include('layouts.defaults')

@navBar(['style' => 'grey darken-3 z-depth-5'])
@endnavBar
<!-- Feed -->
<span id="feedNoAuth"></span>
<a class="btn-floating btn-large waves-effect waves-light   grey darken-4 z-depth-5" id="scrollTop"  data-aos="flip-left">
<i class="material-icons">arrow_upward</i>
</a>
<span id="scrollTopFinalDest"></span>
<div id="feed">
    <div class="row">
            <div class="col s12 m4 l3" ></div>
            @displayPosts(["posts" => $posts, "sm" => "s12 m4 l6"])
            
            @enddisplayPosts
            <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
        <div class="col s12 m4 l3" ></div>      
    </div>
    <div class="row">
            <div class="col s12 m4 l3"><p></p></div>
            
                    @vuePosts(["sm" => "s12 m4 l6"])
                    @endvuePosts
            
            <div class="col s12 m4 l3"><p></p></div>
    </div>
</div>


@extends('layouts.defaultsBottom')
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection
