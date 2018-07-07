<h4 class="ui horizontal divider header">
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

                        {{-- <a  class="ui button red" target="_blank" href="https://emojipedia.org" rel="noreferrer"
                        >Go and Grap an 🙂emoji!🙂</a> --}}
                    </div>
                    @endAuth
                @endif
            </div>
        </div>
    </div>