/*eslint no-console: */
let postId = $('#postId').val(),
  postActions = $('#postActionsWishUnWish');

export default function postFunctions(io) {
  // added addPostToWishList outside the Vue instance because 
  // Some wired Error 
  $('#addToWishListButton').on('click', () => {
    //  console.log("addToWishListButton")
    addRemoveFromWishList(postId, 'addToWishList', 'addToWishListButton');
  });
  $('#deletePostFromWithListButton').on('click', () => {
    //  console.log("deletePostFromWithListButton")
    addRemoveFromWishList(postId, 'deleteWishedPost', 'deletePostFromWithListButton');
  });
  addCommentInit();
  addCommentViaTheButton();
  initSocketIo(io);
}

function addRemoveFromWishList(id, endPoint, targetSelection) {
  const axios = window.axios;
  const M = window.M;
  $(`#${targetSelection} > a`).addClass('disabled');
  $(`#${targetSelection}`).off('click');
  axios.post(`/${endPoint}/${id}`, {
    id: id
  }).then(success => {
    $(`#${targetSelection}`).remove();
    switchAddNRemove(endPoint === 'addToWishList');
    M.toast({
      html: `${success.data.message} 🐵`
    });
    updateWishNumbersUI(endPoint === 'addToWishList');
  }).catch(error => {
    $(`#${targetSelection}`).removeClass('disabled');
    console.log(error);
    M.toast({
      html: 'Something went wrong 🤖',
      classes: 'red accent-3'
    });
  });
}

function switchAddNRemove(actionAdd) {
  if (actionAdd) {
    postActions.append(`
            <li id="deletePostFromWithListButton">
                <a class="btn-floating red">
                    <i class="material-icons">bookmark</i>
                </a>
            </li>
        `);
    $('#deletePostFromWithListButton').on('click', () =>
      addRemoveFromWishList(postId, 'deleteWishedPost', 'deletePostFromWithListButton'));
  } else {
    postActions.append(`
        <li id="addToWishListButton">
            <a class="btn-floating red">
                <i class="material-icons">bookmark_border</i>
            </a>
        </li>
    `);
    $('#addToWishListButton').on('click', () =>
      addRemoveFromWishList(postId, 'addToWishList', 'addToWishListButton'));
  }

  reInitFloatingButtonAndToolTips();
}

function reInitFloatingButtonAndToolTips() {
  $('.fixed-action-btn').floatingActionButton();
}

function addCommentInit() {
  let commentInput = $('#commentInput');
  commentInput.keyup((e) => {
    if (e.ctrlKey && e.keyCode === 13) {
      // console.log("Submit the comment", commentInput.val())
      submitComment(commentInput.val());
    } else if (e.keyCode === 13) {
      // console.log("NEW LINE !",  commentInput.val())
    }
  });

}

function addCommentViaTheButton() {
  $('#addCommentButton').click(() => submitComment());
}

function submitComment(comment = undefined) {
  const axios = window.axios;
  const M = window.M;
  let theComment = undefined;
  if (typeof comment === 'undefined') theComment = $('#commentInput').val();
  else theComment = comment;
  theComment = filterTheDataBeforeSubmit(theComment);
  if (theComment.length) {
    axios.post(`/post/${postId}/addComment`, {
      comment: theComment,
      postId: postId
    }).then(success => {
      M.toast({
        html: `${success.data.message} 🐵`
      });
      removeCommentValue();
    }).catch(error => {
      console.log(error);
      M.toast({
        html: 'Something went wrong 🤖',
        classes: 'red accent-3'
      });
    });
  } else M.toast({
    html: 'Something went wrong 🤖'
  });

}

function filterTheDataBeforeSubmit(comment) {
  comment = comment.trim().replace(/(<([^>]+)>)/ig, '');
  return comment;
}

function removeCommentValue() {
  $('#commentInput').val('');
}

function updateWishNumbersUI(increase) {
  let wishedPostsNumber = Number($('#getWishesNumber').text());
  if (increase) {
    wishedPostsNumber++;
    $('#wishesNumberModal').html(`${wishedPostsNumber}`);
    $('.updateWishesNumber').html(`${wishedPostsNumber}`);
  } else {
    wishedPostsNumber--;
    $('#wishesNumberModal').html(`${wishedPostsNumber}`);
    $('.updateWishesNumber').html(`${wishedPostsNumber}`);
  }
}


function initSocketIo(io) {
  const socket = new io('http://mercury.test:3000');
  socket.on(`new-comment:${postId}`, (data) => {
    getTheUser(data.user_id, data);
  });
}

function getTheUser(userId, comment) {
  const M = window.M;
  fetch(`/realTime/get/user/${userId}`)
    .then(res => res.json())
    .then(user => {
      const userWithComment = {
        comment: comment,
        user: user
      };
      const authedUserId = $('#postWrapper').attr('data-authuserid');
      if (user.id != authedUserId) {
        let audio = new Audio('/sounds/new-commnet-all.mp3');
        audio.play();
        M.toast({
          html: `${user.name} added a comment just now !`
        });
      }
      $('#addMoreCommentsHere').append(`
			<div class="col s12 m4">
			  <ul class="collection z-depth-5 commentCollectionRemoveUl">
				<li class="collection-item avatar blue-grey darken-1 white-text  z-depth-5 ">
					<img src="${userWithComment.user.image}" alt="user image" class="circle  z-depth-5 " data-aos="zoom-in">
					<span class="title">
					<a class="usernameComment" data-aos="fade-up" href="/${ userWithComment.user.name }">
						${ userWithComment.user.name }
					</a>
					</span>
					<p>
					<small class="commentDate" data-aos="fade-right">
						📆 ${ new Date(userWithComment.comment.created_at).toLocaleDateString() }	
					</small>
					<br><br>
					<span data-aos="flip-up">
						${ userWithComment.comment.body }
					</span>
					</p>
					<a class="secondary-content" data-aos="flip-up"><i class="material-icons">person_outline</i></a>
				</li>
			  </ul>
			</div>
		`);
    })
    // eslint-disable-next-line no-unused-vars
    .catch(err => M.toast({
      html: 'something went wrong, please refresh the page !'
    }));
}
