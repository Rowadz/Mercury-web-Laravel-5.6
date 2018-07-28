<div class="row">
    @foreach($comments as $comment)
    <div class="col s12 m6" >
        <ul class="collection z-depth-5 commentCollectionRemoveUl">
            <li class="collection-item avatar blue-grey darken-4 white-text  z-depth-5 ">
                    <div class="progress imageLoader{{$comment->id}}">
                            <div class="indeterminate"></div>
                    </div>                          
                <img src="{{ $comment->user->image }}" alt="user image" class="circle  z-depth-5 "  onerror="brokenImageHandling(this, {{$comment->id}})" 
                onload="removeSpecificLoader({{$comment->id}})" 
                onabort="removeSpecificLoader({{$comment->id}})" data-aos="zoom-in">
                <span class="title">
                    <strong class="usernameComment" data-aos="fade-up">
                        🐻  {{ $comment->user->name }} 
                    </strong>
                </span>
                <p> 
                    <small class="commentDate" data-aos="fade-right">
                        📆 {{ $comment->created_at->diffForHumans() }}
                    </small>
                <br><br>
                <span data-aos="flip-up">
                        {{ $comment->body }}
                </span>
                </p>
                <a href="/{{ $comment->user->name }}" class="secondary-content" data-aos="flip-up"><i class="material-icons">person_outline</i></a>
            </li>
        </ul>
    </div>
    @endforeach
    <div id="addMoreCommentsHere">

    </div>
</div>

<!-- Comments and comments form -->
@if($status !== 0 )
    @Auth
    <section class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s6"  data-aos="zoom-out">
                    <textarea  class="validate materialize-textarea" required  v-model="comment" id="commentInput" @keyup.enter="addComment">
                    </textarea>
                    <label for="commentInput">Comment</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="button" name="action" @click="addComment">Submit
            <i class="material-icons right">mode_comment</i>
            </button>            
        </div>
    </section>
    @endAuth
@endif

{{-- <h4 class="ui horizontal divider header">
        <i class="chat icon"></i>
        Comments
</h4>
    <div class="ui grid">
        <div class="sixteen wide column">
            <div class="ui comments">
                
                @foreach($comments as $comment)
                    <div class="comment">
                        <a class="avatar">
                                <div class="ui active inverted dimmer imageLoader{{$comment->id}}">
                                        <div class="ui indeterminate text loader ">Fetching data !</div>
                                </div>
                            <img src="{{ $comment->user->image }}" 
                            onerror="brokenImageHandling(this, {{$comment->id}})" 
                            onload="removeSpecificLoader({{$comment->id}})" 
                            onabort="removeSpecificLoader({{$comment->id}})">
                        </a>
                        <div class="content">
                            <a class="author"
                               href="/@/{{ $comment->user->name }}">{{ $comment->user->name }}</a>
                            <div class="metadata">
                                <div class="date">{{ $comment->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="text">
                                {{ $comment->body }}
                            </div>
                        </div>
                    </div>
                @endforeach
                <div id="addMoreCommentsHere">

                </div>
                @if($status !== 0 )
                    @Auth
                    <div class="ui reply form">
                        <div class="field">
                            <input placeholder="Add your Comment Here"
                              v-model="comment" id="commentInput" value="" @keyup.enter="addComment">
                            </input>
                        </div>
                        <div class="ui primary submit labeled icon button" @click="addComment">
                            <i class="icon edit"></i> Add Comment
                        </div>
                        <div class="ui top left pointing dropdown button" id="emojis">
                            🙂
                            <div class="menu">
                                <div class="item" data-value="😀" onclick="getEmoji(this)">😀</div>
                                <div class="item" data-value="😁" onclick="getEmoji(this)">😁</div>
                                <div class="item" data-value="😂" onclick="getEmoji(this)">😂</div>
                                <div class="item" data-value="🤣" onclick="getEmoji(this)">🤣</div>
                                <div class="item" data-value="😃" onclick="getEmoji(this)">😃</div>
                                <div class="item" data-value="😄" onclick="getEmoji(this)">😄</div>
                                <div class="item" data-value="😅" onclick="getEmoji(this)">😅</div>
                                <div class="item" data-value="😆" onclick="getEmoji(this)">😆</div>
                                <div class="item" data-value="😉" onclick="getEmoji(this)">😉</div>
                                <div class="item" data-value="😍" onclick="getEmoji(this)">😍</div>
                                <div class="item" data-value="🤢" onclick="getEmoji(this)">🤢</div>
                                <div class="item" data-value="🤑" onclick="getEmoji(this)">🤑</div>
                                <div class="item" data-value="👽" onclick="getEmoji(this)">👽</div>
                                <div class="item" data-value="💩" onclick="getEmoji(this)">💩</div>
                                <div class="item" data-value="🤯" onclick="getEmoji(this)">🤯</div>
                                <div class="item" data-value="🤒" onclick="getEmoji(this)">🤒</div>
                                <div class="item" data-value="🤬" onclick="getEmoji(this)">🤬</div>
                            </div>
                          </div>
                    </div>
                    @endAuth
                @endif
            </div>
        </div>
    </div> --}}