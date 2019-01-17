import {
  prependMessage
} from '../helpers/displayData';

/*eslint no-console: */
function subscribeToOpensUserRoom(currentUserId, io) {
  const socket = new io('http://mercury.test:3000');
  socket.on(`newMessage:${currentUserId}`, data => {
    try {
      const userChat = JSON.parse(localStorage.getItem('userChat'));
      if (userChat.username === data.username) {
        prependMessage(data.message, userChat.image, $('#authUserImage').val(), $('#addMessagesHere'));
      }
    } catch (error) {}
    $('[data-usernamenot]').each((i, el) => {
      if (el.innerText === data.username) {
        console.log(el.previousSibling);
        el.parentElement.parentElement.remove();
        $('#displayUsersHere').prepend(`
		<ul class="animated bounce collection msgUser clickable hoverable mt-0" data-user="${data.username}" data-image="${data.image}">
		<li class="collection-item avatar grey darken-1">
		  <img src="${ data.image }" alt="" class="circle">
		  <time class="title" data-usernamenot="${data.username}">${ data.username}</time>
		  <p class="truncate orange-text text-darken-1" data-newmessagelabel="true">
			new message
		  </p>
		  <!-- here number -->
		</li>
	  </ul>
		`);
      }
    });
    playSounds();
    M.toast({ // eslint-disable-line
      html: `<img src="${data.image}" class="circle" height="20px" width="20px"/>${data.username} sent you a message`,
      displayLength: 10000
    });
  });
}

export {
  subscribeToOpensUserRoom
};


function playSounds() {
  let audio = new Audio('/sounds/skypePOP.mp3');
  audio.play()
    .then(() => console.log('playing sounds...'))
    .catch(err => console.log(err));
}
