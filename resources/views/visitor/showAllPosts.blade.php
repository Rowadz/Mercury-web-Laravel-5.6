@include('layouts.defaults')

@navBar(
                [
                'allFollowers' => isset($allFollowers) ? $allFollowers : null,
                'allFollowedByTheUser' => isset($allFollowedByTheUser) ? $allFollowedByTheUser : null,
                'wishes' => isset($wishes) ? $wishes : null,
                'style' => 'grey darken-3 z-depth-5'
                ]
                )
@endnavBar
<!-- Feed -->
<span id="feedNoAuth"></span>
<a class="btn-floating btn-large waves-effect waves-light  yellow darken-4 z-depth-5" id="scrollTop" >
<i class="material-icons">arrow_upward</i>
</a>
<section id="feed" class="row">
        
                <div class="col s12 m12  ">
                   <!-- <div class="container"> -->
                   <div class="row">
        @displayPosts(["posts" => isset($posts) ? $posts : null, 'sm' => 's12 m4'])

        @enddisplayPosts

        <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
        <!-- Loaded posts from ajax call -->
        
        @vuePosts()

        @endvuePosts
                   </div>
                </div>
        
</section>



@extends('layouts.defaultsBottom')
@section('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
{{-- <script>
   const x = new Vue({
       el: "#feed",
       data: {
           posts: [],
           lastId: $("#lastId").val(),
           counter : 0,
           commentNumber : [],
           tagNames: [],
           users: [],
           imageLocation: []
       },
       methods: {
           loadMorePosts(){
               $("#dimmerHere").html(`
                   <div class="ui active  dimmer">
                      <div class="ui text loader">Loading</div>
                   </div>
                   <p></p>
               `)
               axios.post('/show/all/postsNoAuth', {
                   lastId: this.lastId
               })
                   .then((response) => {
                       $("#dimmerHere").html("<p>Press Here to load more posts</p>")
                       //console.log(typeof (response.data.posts))
                       let allPosts = response.data.posts
                       let x = allPosts.length
                       for(let i = 0; i < x; i++) this.posts.push(allPosts[i])
                       // console.log(this.posts)
                       let allCommentNumber = response.data.commentNumber
                       x = allCommentNumber.length
                       for(let i = 0; i < x; i++) this.commentNumber.push(allCommentNumber[i])
                       //this.commentNumber = response.data.
                       allTagsNames = response.data.tagNames
                       x =  allTagsNames.length
                       for(let i = 0; i < x; i++) this.tagNames.push(allTagsNames[i])
                       users = response.data.users
                       x =  users.length
                       for(let i = 0; i < x; i++) this.users.push(users[i])
                       //this.tagNames = response.data.tagNames
                       imageLocation = response.data.imageLocation
                       x = imageLocation.length
                       for(let i = 0; i < x; i++) this.imageLocation.push(imageLocation[i])
                       this.lastId = allPosts[allPosts.length -1 ].id
                       //console.log(this.lastId)
                       $('#dimmerImage').attr("src", "/images/returnHome.png")
                       let audio = new Audio('/sounds/service-bell_daniel_simion.mp3')
                       audio.play()
                   })
                   .catch((error) => {
                       let audio = new Audio('/sounds/Lightsaber_Turn_Off.mp3')
                       audio.play()
                       $('#dimmerImage').attr("src", "/images/404.png")
                       $("#dimmerHere").html(`
                          <h1>OOps! 😣😣</h1>
                         <p>🤔Something bad happened press again🤔</p>
                               `)
                   })
           }
       }
   })
</script> --}}
@endsection
