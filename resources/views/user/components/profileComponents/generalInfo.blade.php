<div class=" column ">
    <p class="faildToLoadImage">faild to load image 🤷, the handler image will be loaded</p>
    <div class="ui active massive centered inline loader green" id="imageLoader"></div>
    <img src="{{ Auth()->user()->image }}" alt="user image" class="ui image center aligned"
     onerror="brokenImageHandling(this)" onload="removeLoader()" onabort="removeLoader()">
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
                <button class="ui  gray button" onclick="unFollow({{ $followId }})">
                    <i class="heart  icon black"></i>
                    Un-Follow
                </button>
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
                <button class="ui orange button"  onclick="follow({{ $user->id }})">
                    <i class="heart outline icon black"></i>
                    Follow
                </button>
            @endif
            <button class="ui inverted blue button">
            <i class="comments icon black"></i>
                Chat
            </button>
    @else
            <a href="#!" class="ui inverted blue button">
            <i class="comments icon black"></i>
                Go to your Chat
            </a>
    @endif
 </div>