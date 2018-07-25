
        
                @displayPosts(["posts" => $posts])
                
                @enddisplayPosts
                <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
            <!-- Loaded posts from ajax call -->
                @vuePosts()
                @endvuePosts
