import {
  socketURL
} from "../helpers/socketURL";

/*eslint no-console: */
export default function notifications(io) {
  const authUserIdForNotify = $('#authUserIdForNotify').val();
  const socket = new io(socketURL);
  commentOnYourPost(socket, authUserIdForNotify);
  followRequestApproved(socket, authUserIdForNotify);
  newFollowRequest(socket, authUserIdForNotify);
  newExchangeRequest(socket, authUserIdForNotify);
  exchangeRequestApproved(socket, authUserIdForNotify);
  // TODO  :: chat notification if the user not in the chat page !
  // TODO  :: or not t  alking with a user that he/she sent them ...
}


/**
 *
 *
 * @param {*} socket
 * @param {int} userId
 */
function commentOnYourPost(socket, userId) {
  const M = window.M;
  socket.on(`newCommentNotify:${userId}`, data => {
    if (userId != data.commentUserId) {
      playSounds('comment');
      const toastHTML = `<span>${data.username} just commented on your "<span class="light-blue-text text-lighten-3">${data.postHeader}</span> " </span><a href="/show/post/${data.postId}" class="btn-flat toast-action">Go</a>`;
      M.toast({
        html: toastHTML,
        classes: 'rounded',
        displayLength: 7000
      });
    }
  });
}

/**
 *
 *
 * @param {*} socket
 * @param {int} userId
 */
function newFollowRequest(socket, userId) {
  const M = window.M;
  socket.on(`newFollowRequestNotify:${userId}`, data => {
    playSounds('follow');
    M.toast({
      html: `${data.username} just sent you a follow request !`,
      classes: 'rounded',
    });
    let incrByOne = $('.updateFollowRequestsNumber').text();
    incrByOne = Number.parseInt(incrByOne);
    $('.updateFollowRequestsNumber').html(`${incrByOne + 1}`);
  });
}
/**
 *
 *
 * @param {*} socket
 * @param {int} userId
 */
function followRequestApproved(socket, userId) {
  const M = window.M;
  socket.on(`approvedFollowNotify:${userId}`, data => {
    playSounds('follow');
    M.toast({
      html: `<span class="light-blue-text text-lighten-3">${data.theUserThatApprovedname} </span> just approved your follow request !`,
      classes: 'rounded',
    });
  });
}

/**
 *
 *
 * @param {*} socket
 * @param {int} userId
 */
function newExchangeRequest(socket, userId) {
  const M = window.M;
  socket.on(`newExchangeRequestNotify:${userId}`, data => {
    playSounds('comment');
    M.toast({
      html: `<span class="light-blue-text text-lighten-3">${data.username} </span>  just sent an exchange request !`,
      classes: 'rounded',
    });
  });
}

/**
 *
 *
 * @param {*} socket
 * @param {int} userId
 */
function exchangeRequestApproved(socket, userId) {
  const M = window.M;
  socket.on(`exchangeRequestApprovedNotify:${userId}`, data => {
    playSounds('comment');
    // TODO make better  message  !
    M.toast({
      html: `<span class="light-blue-text text-lighten-3">${data.username}  </span>   
	  			   just accepted your echange request with =>  <span class="light-blue-text text-lighten-2">  ${data.postHeader} </span>
	  			! go and talk with them !`,
      classes: 'rounded',
      displayLength: 10000
    });
  });
}


/**
 *
 * @param {stirng} type
 */
function playSounds(type) {
  switch (type) {
    case 'follow':
      type = '/sounds/followRequest.mp3';
      break;
    case 'comment':
      type = '/sounds/skypePOP.mp3';
  }
  let audio = new Audio(type);
  audio.play()
    .then(() => console.log('playing sounds...'))
    .catch(err => console.log(err));
}
