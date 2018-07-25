{{-- 
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
--}}
<!-- Press Here to load more card -->
{{-- 
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
--}}
<section class="cardsAjax">
    
        <div class="col s12 m4"  v-for="(post, index) in posts">
                <div class="card  cyan darken-3  z-depth-5">
                   <div class="row">
                      <div class="col s12 m12 right-align">
                         <div class="chip z-depth-5 tagChip" data-aos="zoom-in-up">
                            <a href="#!" class="right-align">
                                    @{{ tagNames[index] }}
                            </a>
                         </div>
                      </div>
                   </div>
                   <div class="card-image">
                      
                      
                      <!-- Each loader will have a uniqe class name and should be removed when the image loadeed or if there is an error  ! -->
                      {{-- <div :class="'progress imageLoader' + post.id">
                         <div class="indeterminate"></div>
                      </div> --}}
                      
                      <img  
                         {{-- @onerror="brokenImageHandling(this)" 
                         @onload="removeSpecificLoader(post.id)" 
                         @onabort="removeSpecificLoader(post.id)"   --}}
                         class="responsive-img" data-aos="zoom-in-left"
                         :src="imageLocation[index]"
                         >
        
                      <span class="card-title">
                      <strong class="chip strongChips grey darken-3 blue-text" data-aos="zoom-out-up">
                            @{{ post.header }}
                      </strong>   
                      </span>
                      <a class="btn-floating halfway-fab  waves-effect waves-teal blue-grey darken-4 z-depth-5"
                         :href=`/show/post/${post.id}` target="_blank" rel="noreferrer" data-aos="fade-right" >
                      <i class="material-icons">free_breakfast</i>
                      </a>
                   </div>
                   <div class="card-content cyan lighten-3">
                      <div class="row">
                         <div class="col s12 m12">
                            <div class="chip z-depth-5 strongChips" data-aos="fade-down-left">
                               🐨 @{{ users[index] }}
                            </div>
                            <div class="chip z-depth-5" data-aos="fade-down-right">
                               📅 @{{ post.created_at }}
                            </div>
                            <div class="chip z-depth-5" data-aos="fade-up-left">
                               💬 @{{ commentNumber[index] }}
                            </div>
                         </div>
                      </div>
                      <p class="flow-text truncate">
                            @{{ post.body}}
                      </p>
                   </div>
                </div>
             </div>
        
        
            </section>  
        

{{-- 
<div class="col s12 m12 l12" >
        <!-- <div class="container"> -->
        <div class="row"> --}}
        <div class="col s12 m4">
           <div class="card  cyan darken-3 hoverable z-depth-5">
              <div class="row">
                <div class="col s6 m6">
                            <button  @click="loadMorePosts" class="btn-floating btn-large waves-effect waves-light z-depth-5" id="dimmerHere">
                                More
                            </button>
                </div>
                 <div class="col s6 m6 right-align">
                    <div class="chip z-depth-5 tagChip">
                       <a href="#!" class="right-align">Tag name</a>
                    </div>
                 </div>
              </div>
              <div class="card-image">
                 <img src="{{asset('images/returnHome.png')}}" class="responsive-img scale-transition" id="dimmerImage">
                 <span class="card-title black-text">
                 <strong class="chip strongChips">
                 Post Title
                 </strong>   
                 </span>
                 <a class="btn-floating halfway-fab  waves-effect waves-teal blue-grey darken-4 z-depth-5">
                 <i class="material-icons">free_breakfast</i>
                 </a>
              </div>
              <div class="card-content cyan lighten-3">
                 <div class="row">
                    <div class="col s12 m12">
                       <div class="chip z-depth-5 strongChips">
                          🐨
                       </div>
                       <div class="chip z-depth-5">
                          📅
                       </div>
                       <div class="chip z-depth-5">
                          💬
                       </div>
                    </div>
                 </div>
                 <p class="flow-text" >
                    Click The load button
                 </p>
              </div>
           </div>
        </div>
        {{-- </div>
</div> --}}
