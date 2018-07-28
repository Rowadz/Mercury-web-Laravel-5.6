@include('layouts.defaults')


        <!-- Nav -->
            {{-- @include('layouts.nabBarWelcome') --}}
            @navBarWelcome(
                    [
                        // 'allFollowers' => $allFollowers,
                        // 'allFollowedByTheUser' => $allFollowedByTheUser,
                        // 'wishes' => $wishes,
                        'style' => 'grey darken-3 z-depth-5'
                    ]
                    )
            @endnavBarWelcome
        <!-- End Nav -->
        
    <div  id="feed">
        <div class="row">
                @displayPosts(["posts" => $posts])
                
                @enddisplayPosts
                <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
            <!-- Loaded posts from ajax call -->
                @vuePosts()
                @endvuePosts

        </div>
    </div>

@extends('layouts.defaultsBottom')
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection

