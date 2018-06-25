<div class="twelve wide computer column sixteen wide mobile column
            column sixteen wide tablet column myCardOnSmallScreens">
        <div class="ui link cards">
                @displayPosts(["posts" => $posts])
                
                @enddisplayPosts
                <input type="text" id="lastId"  hidden value="{{ $posts[sizeof($posts) - 1]->id }}" >
            <!-- Loaded posts from ajax call -->
                <div class="myCard card animated flipInX" v-for="(post, index) in posts">
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