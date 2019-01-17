<section id="profileWrapperGeneralInfo">
  <div class="card z-depth-5 blue-grey darken-4 hoverable">
    <div class="card-image waves-effect waves-block waves-light">
      <div class="progress imageLoader{{$user->id . '00000'}}">
        <div class="indeterminate"></div>
      </div>
      <img class="activator z-depth-5" src="{{ $user->image}}" onerror="brokenImageHandling(this, {{$user->id . '00000'}})"
        onload="removeSpecificLoader({{ $user->id . '00000' }})" onabort="removeSpecificLoader({{ $user->id . '00000' }})">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-lighten-2">
        {{ $user->name }}
        <i class="material-icons right">more_vert</i>
      </span>
      <blockquote class="flow-text aboutText blue-grey-text text-lighten-4">
        {{ substr ($user->about, 100) }}
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
          👽 Following <span class="userInfoRevealCard">
            {{ $following }}
          </span>
        </div>
        <div class="col s12 m12 userInfoRevealCardMailTitle">
          🛸 Posts <span class="userInfoRevealCard">
            {{ sizeof($user->posts) }}
          </span>
        </div>
        <div class="col s12 m12 userInfoRevealCardMailTitle">
          🎉 Joined <span class="userInfoRevealCard">
            {{ $user->created_at->diffForHumans() }}
          </span>
        </div>
        <div class="col s12 m12 userInfoRevealCardMailTitle">
          ☃️ Date of Birth <span class="userInfoRevealCard">
            {{ isset($user->date_of_birth) ? $user->date_of_birth : "no data .." }}
          </span>
        </div>
        <table>
          <thead>
            <tr>
              <th><img src="{{ asset('images/happy.png') }}" alt="happy" width="50px"></th>
              <th><img src="{{ asset('images/sad.png') }}" alt="sad" width="50px"></th>
              <th><img src="{{ asset('images/angry.png') }}" alt="angry" width="50px"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <h5>{{ $reviews['happy'] }}</h5>
              </td>
              <td>
                <h5>{{ $reviews['sad'] }}</h5>
              </td>
              <td>
                <h5>{{ $reviews['angry'] }}</h5>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-reveal  grey darken-4 grey-text text-lighten-4">
      <span class="card-title ">Actions<i class="material-icons right">close</i></span>
      <div class="row">
        @if(Auth()->user()->id !== $user->id)
        @if($iamIFollowingThisUser === 'canUnfollow')
        <div class="col s12 m12 actionsButtonsProfile ">
          <a class="waves-effect waves-light btn hoverable blue darken-2 modal-trigger
                    btn-large"
            href="#unfollowModal" style="width:100%">
            Unfollow
          </a>
        </div>
        <div id="unfollowModal" class="modal blue-grey darken-4">
          <div class="modal-content">
            <h4>UnFollow request</h4>
            <p>Do you want to UnFollow {{ $user->name }} ? </p>
            <form action="/unfollowUser" method="post" id="unfollowForm">
              @method('DELETE')
              @csrf
              <input type="text" hidden value="{{ $followId }}" name="row_id">
              <div class="row">
                <div class="input-field">
                  <button class="btn-floating waves-effect waves-green approve  userInfoRevealCard  light-blue lighten-3"
                    id="unFollowConfirmed" type="submit">
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
        @elseif($iamIFollowingThisUser == 'canCancel')
        <div class="col s12 m12 actionsButtonsProfile ">
          <a class="waves-effect waves-light btn hoverable blue darken-2 modal-trigger 
                    btn-large"
            href="#cancelModal" style="width:100%">
            Cancel Request
          </a>
        </div>
        <div id="cancelModal" class="modal blue-grey darken-4">
          <div class="modal-content">
            <h4>Cancel request</h4>
            <p>Do you want to Cancel follow request ? </p>
            <form action="/cancelFollow" method="post" id="cancelForm">
              @method('DELETE')
              @csrf
              <input type="text" hidden value="{{ $followId }}" name="row_id">
              <div class="row">
                <div class="input-field">
                  <button class="btn-floating waves-effect waves-green approve  userInfoRevealCard  light-blue lighten-3"
                    id="cancelConfirmed" type="submit">
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
        <div class="col s12 m12 actionsButtonsProfile">
          <a class="waves-effect waves-light btn hoverable blue darken-2 modal-trigger
                    btn-large"
            href="#followModal" style="width:100%">
            Follow
          </a>
        </div>
        <div id="followModal" class="modal blue-grey darken-4">
          <div class="modal-content">
            <h4>Send request</h4>
            <p>Do you want to follow {{ $user->name }}? </p>
            <form action="/followUser" method="post" id="followForm">
              @csrf
              <input type="text" hidden value="{{ $user->id }}" name="user_id">
              <div class="row">
                <div class="input-field">
                  <button class="btn-floating waves-effect waves-green approve  userInfoRevealCard  light-blue lighten-3"
                    id="sendConfirmed" type="submit">
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
        <div class="col s12 m12 actionsButtonsProfile">
          <a class="waves-effect waves-light btn hoverable  cyan darken-3 btn-large z-depth-5" style="width:100%">
            Chat
          </a>
        </div>
        @else
        {{-- <div class="col s12 m12 actionsButtonsProfile">
          <a class="waves-effect waves-light btn hoverable  cyan darken-1 btn-large z-depth-5" style="width:100%">
            Your chat
          </a>
        </div> --}}
        @endif
        <div class="col s12 m12 actionsButtonsProfile">
          <a class="waves-effect waves-light btn hoverable  deep-orange lighten-1 btn-large" href="/posts/{{$user->name}}/DescendingNAvailable/"
            style="width:100%">
            Posts
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
