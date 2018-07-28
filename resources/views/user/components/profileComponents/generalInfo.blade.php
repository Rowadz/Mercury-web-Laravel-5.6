<div class="card z-depth-5 blue-grey darken-4 hoverable">
        <div class="card-image waves-effect waves-block waves-light">
           <div class="progress imageLoader{{$user->id . '00000'}}">
              <div class="indeterminate"></div>
           </div>
           <img class="activator z-depth-5" src="{{ $user->image}}"  onerror="brokenImageHandling(this, {{$user->id . '00000'}})" 
              onload="removeSpecificLoader({{ $user->id . '00000' }})" 
              onabort="removeSpecificLoader({{ $user->id . '00000' }})">
        </div>
        <div class="card-content">
           <span class="card-title activator grey-text text-lighten-2">
           {{ $user->name }}
           <i class="material-icons right">more_vert</i>
           </span>
           <blockquote class="flow-text aboutText blue-grey-text text-lighten-4"> 
              {{ substr ($user->about, sizeof($user->about) - 100) }}
              <br>
              <a class="red-text text-accent-2 modal-trigger" href="#aboutModal">
              read More ⟿ 
              </a>
           </blockquote>
           <!-- Modal Structure -->
           <div id="aboutModal" class="modal z-depth-5">
              <div class="modal-content">
                 <h4>About</h4>
                 <p>
                    {{ $user->about }}
                 </p>
              </div>
              <div class="modal-footer">
                 <a href="#!" class="modal-close waves-effect waves-green btn-flat">Dismiss</a>
              </div>
           </div>
           <div class="divider"></div>
           <div class="row grey-text text-lighten-2">
              <div class="col s12 m12 userInfoRevealCardMailTitle">
                 👾 Followers 
                 <span class="userInfoRevealCard">{{ $followers }}</span>
              </div>
              <div class="col s12 m12 userInfoRevealCardMailTitle">
                 👽  Following <span class="userInfoRevealCard">
                 {{ $following }}
                 </span>
              </div>
              <div class="col s12 m12 userInfoRevealCardMailTitle">
                 🛸  Posts <span class="userInfoRevealCard">
                 {{ sizeof($user->posts) }}
                 </span>
              </div>
              <div class="col s12 m12 userInfoRevealCardMailTitle">
                 🎉  Joined <span class="userInfoRevealCard">
                 {{ $user->created_at->diffForHumans() }}
                 </span>
              </div>
              <div class="col s12 m12 userInfoRevealCardMailTitle">
                 ☃️  Date of Birth <span class="userInfoRevealCard">
                 {{ isset($user->date_of_birth) ? $user->date_of_birth : "no data .." }}
                 </span>
              </div>
           </div>
        </div>
        <div class="card-reveal  grey darken-4 grey-text text-lighten-4">
           <span class="card-title ">Actions<i class="material-icons right">close</i></span>
           <div class="row">
              @if(Auth()->user()->id !== $user->id)
              @if($iamIFollowingThisUser === 1)
              <div class="col s6 m6 actionsButtonsProfile ">
                 <a class="waves-effect waves-light btn hoverable blue darken-2 modal-trigger
                    btn-large"
                    href="#unfollowModal">
                 Unfollow
                 </a>
              </div>
              <div id="unfollowModal" class="modal blue-grey darken-4">
                 <div class="modal-content">
                    <h4>UnFollow request</h4>
                    <p>Do you want to UnFollow {{ $user->name }} ? </p>
                    <form action="/unfollowUser"  method="post" id="unfollowForm">
                       @csrf
                       <input type="text" hidden value="{{ $followId }}" name="row_id">
                       <div class="row">
                          <div class="input-field">
                             <button  class="btn-floating waves-effect waves-green approve  userInfoRevealCard  light-blue lighten-3" id="unFollowConfirmed"
                                type="submit">  
                             <i class="material-icons">check</i>
                             </button>
                             <a href="#!" class="btn-floating waves-effect waves-red cancel floatLeftModalFooter red lighten-3 modal-close">
                             <i class="material-icons">close</i>
                             </a>
                          </div>
                       </div>
                    </form>
                 </div>
              </div>
              @elseif($iamIFollowingThisUser == 2 || $iamIFollowingThisUser === 0)
              <div class="col s6 m6 actionsButtonsProfile ">
                 <a class="waves-effect waves-light btn hoverable blue darken-2 modal-trigger 
                    btn-large" href="#cancelModal">
                 Cancel Request
                 </a>
              </div>
              <div id="cancelModal" class="modal blue-grey darken-4">
                 <div class="modal-content">
                    <h4>Cancel request</h4>
                    <p>Do you want to Cancel follow request ? </p>
                    <form action="/cancelFollow"  method="post" id="cancelForm">
                       @csrf
                       <input type="text" hidden value="{{ $followId }}" name="row_id">
                       <div class="row">
                          <div class="input-field">
                             <button  class="btn-floating waves-effect waves-green approve  userInfoRevealCard  light-blue lighten-3" id="cancelConfirmed"
                                type="submit">  
                             <i class="material-icons">check</i>
                             </button>
                             <a href="#!" class="btn-floating waves-effect waves-red cancel floatLeftModalFooter red lighten-3 modal-close">
                             <i class="material-icons">close</i>
                             </a>
                          </div>
                       </div>
                    </form>
                 </div>
              </div>
              @else 
              <div class="col s6 m6 actionsButtonsProfile">
                 <a class="waves-effect waves-light btn hoverable blue darken-2 modal-trigger
                    btn-large" 
                    href="#followModal">
                 Follow
                 </a>
              </div>
              <div id="followModal" class="modal blue-grey darken-4">
                 <div class="modal-content">
                    <h4>Send request</h4>
                    <p>Do you want to  follow  {{ $user->name }}? </p>
                    <form action="/followUser"  method="post" id="followForm">
                       @csrf
                       <input type="text" hidden value="{{ $user->id }}" name="user_id">
                       <div class="row">
                          <div class="input-field">
                             <button  class="btn-floating waves-effect waves-green approve  userInfoRevealCard  light-blue lighten-3" id="sendConfirmed"
                                type="submit">  
                             <i class="material-icons">check</i>
                             </button>
                             <a href="#!" class="btn-floating waves-effect waves-red cancel floatLeftModalFooter red lighten-3 modal-close">
                             <i class="material-icons">close</i>
                             </a>
                          </div>
                       </div>
                    </form>
                 </div>
              </div>
              @endif
              <div class="col s6 m6 actionsButtonsProfile">
                 <a class="waves-effect waves-light btn hoverable  cyan darken-3 btn-large">
                 Chat
                 </a>
              </div>
              @else 
              <div class="col s6 m6 actionsButtonsProfile">
                 <a class="waves-effect waves-light btn hoverable  cyan darken-3 btn-large">
                 💬
                 </a>
              </div>
              @endif
              <div class="col s6 m6 actionsButtonsProfile">
                 <a class="waves-effect waves-light btn hoverable  deep-orange lighten-1 btn-large"
                 href="/posts/{{$user->name}}/DescendingNAvailable/">
                 Posts
                 </a>
              </div>
           </div>
        </div>
     </div>
     {{-- 
     {{-- 
     <div class="ui active massive centered inline loader green imageLoader"></div>
     --}}
     {{--  
     <div class=" column ">
        <p class="faildToLoadImage">faild to load image 🤷, the handler image will be loaded</p>
        <div>
           <div class="ui active dimmer imageLoader">
              <div class="ui indeterminate text loader ">Fetching Image</div>
           </div>
           <img src="{{ Auth()->user()->image }}" 
              alt="user image"
              class="ui image center aligned"
              onerror="brokenImageHandling(this)" onload="removeLoader()" onabort="removeLoader()">
        </div>
     </div>
     <div class=" column">
        <h4 class="ui horizontal divider header">
           <i class="user circle outline
              icon"></i>
           General information
        </h4>
        <h3>
           <i class="coffee icon"></i>
           Registered : 
           <span class="orange "> 
           {{ $user->created_at->diffForHumans() }}
           </span>
        </h3>
        <h3>
           <i class="birthday cake icon"></i>
           Date of Birth : 
           <span class="orange">
           {{ isset($user->date_of_birth) ? $user->date_of_birth : "no data ..." }}
           </span>
        </h3>
        <h3>
           <i class="newspaper icon"></i>
           Number of Posts :  
           <span class="orange">
           {{ sizeof($user->posts) }}
           </span>
        </h3>
        <p>
           <i class="address card icon"></i>
           <b>About</b>
           {{ isset($user->about) ? $user->about : "No data ..." }}
        </p>
        @if(Auth()->user()->id !== $user->id)
        @if($iamIFollowingThisUser === 1)
        <button class="ui  gray button" onclick="unFollow()">
        <i class="heart  icon black"></i>
        UnFollow
        </button>
        <div class="ui modal" id="unfollowModal">
           <div class="header">UnFollow request</div>
           <div class="content">
              <p>Do you want to UnFollow {{ $user->name }} ? </p>
              <form action="/unfollowUser" hidden method="post" id="unfollowForm">
                 @csrf
                 <input type="text" hidden value="{{ $followId }}" name="row_id">
              </form>
           </div>
           <div class="actions">
              <div class="ui cancel button red">Cancel</div>
              <div class="ui approve button green">Approve</div>
           </div>
        </div>
        @elseif($iamIFollowingThisUser === 2 || $iamIFollowingThisUser === 0)
        <button class="ui red button" onclick="cancel()">
        <i class="times  icon black"></i>
        Cancel request
        </button>
        <div class="ui modal" id="cancelModal">
           <div class="header">Cancel request</div>
           <div class="content">
              <p>Do you want to cancel the follow request ? </p>
              <form action="/cancelFollow" hidden method="post" id="cancelForm">
                 @csrf
                 <input type="text" hidden value="{{ $followId }}" name="row_id">
              </form>
           </div>
           <div class="actions">
              <div class="ui cancel button red">Cancel</div>
              <div class="ui approve button green">Approve</div>
           </div>
        </div>
        @else
        <button class="ui orange button"  onclick="follow()">
        <i class="heart outline icon black"></i>
        Follow
        </button>
        <div class="ui modal" id="followModal">
           <div class="header">Send request</div>
           <div class="content">
              <p>Do you want to follow {{ $user->name }} ? </p>
              <form action="/followUser" hidden method="post" id="followForm">
                 @csrf
                 <input type="text" hidden value="{{ $user->id }}" name="user_id">
              </form>
           </div>
           <div class="actions">
              <div class="ui cancel button red">Cancel</div>
              <div class="ui approve button green">Approve</div>
           </div>
        </div>
        @endif
        <button class="ui inverted blue button" onclick="openChat()">
        <i class="comments icon black"></i>
        Chat
        </button>
        <div class="ui modal" id="chatModal">
           <div class="header">Chating with
              <span class="orange"> 
              {{ $user->name }}
              </span>
           </div>
           <div class="scrolling content">
              {{-- Chat messages 
           </div>
        </div>
        @else
        {{-- means you are seeing your self 
        <a href="#!" class="ui inverted blue button">
        <i class="comments icon black"></i>
        Go to your Chat
        </a>
        @endif
        <a href="/posts/{{$user->name}}" class="ui inverted black button blackText">
        <i class="circle outline icon teal"></i>
        See Posts
        </a>
     </div>
     --}}