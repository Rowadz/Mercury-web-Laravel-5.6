<div class="row">
  @foreach($comments as $comment)
  <div class="col s12 m4">
    <ul class="collection z-depth-5 commentCollectionRemoveUl">
      <li class="collection-item avatar blue-grey darken-4 white-text  z-depth-5 ">
        <img src="{{ $comment->user->image }}" alt="user image" class="circle  z-depth-5 " data-aos="zoom-in">
        <span class="title">
          <a class="usernameComment" data-aos="fade-up" href="/{{ $comment->user->name }}">
            {{ $comment->user->name }}
          </a>
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
        <a class="secondary-content" data-aos="flip-up"><i class="material-icons">person_outline</i></a>
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
      <div class="input-field col s6 m6">
        <textarea class="validate materialize-textarea tooltipped" id="commentInput" data-position="top" data-tooltip="Enter = NEW LINE. Enter + CTRL = add comment"></textarea>
        <label for="commentInput">Comment</label>
      </div>
      <div class="col s6 m6">
        <button class="btn waves-effect waves-green white black-text" type="button" name="action" id="addCommentButton">add
          Comment
          <i class="material-icons right">mode_comment</i>
        </button>
      </div>
    </div>
  </div>
</section>
@endAuth
@endif
