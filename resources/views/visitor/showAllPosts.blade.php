@extends('layouts.app')
@section('content')
    <div class="ui grid" id="feed">
        <div class="row" id="feedNoAuth">
            <div class="myCardOnSmallScreens sixteen wide column ">
                <div class="ui link cards">
                        @displayPosts(["posts" => $posts])
                        @enddisplayPosts
                    <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
                    <!-- Loaded posts from ajax call -->
                    <div class="myCard card" v-for="(post, index) in posts">
                        <div class="image">
                            <img class="ui image" :src="imageLocation[index]">
                        </div>
                        <div class="content">
                            <div class="header">@{{ post.header }}</div>
                            <div class="meta">

                                <a class="ui red right ribbon label" rel="noreferrer"
                                   v-if="post.tag_id == 1" >
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui teal right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 2">
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui orange right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 3">
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui yellow right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 4">
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui green right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 5">
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui blue right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 6">
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui violet right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 7">
                                    @{{ tagNames[index] }}
                                </a>
                                <a class="ui black right ribbon label" rel="noreferrer"
                                   v-else-if="post.tag_id == 8">
                                    @{{ tagNames[index] }}
                                </a>
                            </div>
                            <div class="description">
                                <h4 style="color: #2e3436;">@{{ users[index] }} says : </h4>
                                <p>
                                    @{{ post.body.substring(1400)}}
                                    <a :href=`/show/post/${post.id}`
                                       rel="noreferrer" target="_blank"
                                       class="continueReadingATag">CONTINUE READING....👁</a>
                                </p>
                            </div>
                        </div>
                        <div class="extra content">
                                 <span class="right floated">
                                     @{{     post.created_at}}
                                 </span>
                            <span>
                                    💬 @{{ commentNumber[index] }}
                                </span>
                        </div>
                    </div>

                    <!-- Press Here to load more card -->
                    <div class="myCard card" @click="loadMorePosts">
                        <div class="image">
                            <img class="ui image" src="{{asset('images/returnHome.png')}}" id="dimmerImage">
                        </div>
                        <div class="content">
                            <div class="header">Header</div>
                            <div class="meta">
                                <a class="ui olive right ribbon label" rel="noreferrer">
                                    🔖
                                </a>
                            </div>
                            <div class="description" id="dimmerHere">

                                <p> Press here to load more posts

                                </p>
                            </div>
                        </div>
                        <div class="extra content">
                                 <span class="right floated">
                                      📅
                                 </span>
                            <span>
                                    ### 💬
                                </span>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
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