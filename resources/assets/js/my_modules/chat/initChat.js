/*eslint no-console: */
import {
  usernamesPagination,
  mapUsernamesPagination,
} from './helpers/usernamesPagination';
import * as dd from './helpers/displayData';
import {
  messagesPagination,
  mapMessagesPaginationPagination,
  resetMessagesPagination
} from './helpers/messagesPagination';
import {
  sendMessageInit
} from './sendMessage/sendMessage';
const userData = {
  username: '',
  image: ''
};
const prevUserData = {
  username: '',
};
export default function initChat(io) {
  M.toast({ // eslint-disable-line
    html: 'you can click&nbsp;<span class="amber-text text-lighten-3">ctrl + m &nbsp;</span> to start send a message',
    displayLength: 10000
  });
  $(document).on('keyup', e =>
    ($('#chat').length && e.ctrlKey && e.keyCode === 77) ?
    M.Modal.getInstance($('#addMessage')).open() // eslint-disable-line
    :
    undefined
  );
  getUserNames(usernamesPagination);
  addEventListeners(io);
}



function addEventListeners(io) {
  $(document).on('click', '[data-user]', function () {
    userData.username = $(this).attr('data-user');
    userData.image = $(this).attr('data-image');
    getMessages(userData.username, userData.image, true);
    sendMessageInit(userData);
  });
  $('#scrollDisplayUsersHere').scroll(function () {
    if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) getUserNames();
  });
  $('#scrollDisplayMessagesHere').scroll(function () {
    if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
      getMessages(userData.username, userData.image, false);
    }
  });


}

async function getUserNames() {
  let displayUsersHere = $('#displayUsersHere');
  let loadingUsersNames = $('#loadingUsersNames');
  try {
    const names = await fetchNames();
    loadingUsersNames.hide();
    // console.log(names); // from here you can go the next 10 users
    mapUsernamesPagination(names);
    // console.log(usernamesPagination);
    if (names.data.length === 0) {
      someoneIsShy(displayUsersHere);
    } else {
      displayUsers(names.data, displayUsersHere);
    }
  } catch (error) {
    if (error === 'done') M.toast({ // eslint-disable-line
      html: 'No more users'
    });
    else
      M.toast({ // eslint-disable-line
        html: 'Something went wrong while loading the users, try again later'
      });
  }
}

function displayUsers(names, displayUsersHere) {
  dd.displayUsers(names, displayUsersHere);
}

function someoneIsShy(displayUsersHere) {
  dd.someoneIsShy(displayUsersHere);
}


async function fetchNames() {
  if (usernamesPagination.current_page === usernamesPagination.last_page)
    return Promise.reject('done');
  return usernamesPagination.next_page_url === undefined ?
    fetch('/user/getChatNames').then(res => res.json()) :
    fetch(`${usernamesPagination.next_page_url}`).then(res => res.json());
}

function getMessages(name, image, clicked) {
  const addMessagesHere = $('#addMessagesHere');
  console.log(name, prevUserData);
  if (name !== prevUserData.username && clicked) {
    addMessagesHere.html('');
    resetMessagesPagination();
  }
  prevUserData.username = name;
  const loader = '<div class="progress mt-5" id="chatPreloader"><div class="indeterminate"></div></div>';
  if (messagesPagination.current_page === messagesPagination.last_page)
    return;

  messagesPagination.next_page_url === undefined ?
    fetch(`/user/chat/${name}`).then(res => res.json()).then(res => {
      // console.log(res);
      mapMessagesPaginationPagination(res);
      console.log(messagesPagination);
      $('#chatPreloader').remove();
      // res.data = res.data.reverse();
      res.data.forEach(msg => {
        dd.displayMessages(msg, image, $('#authUserImage').val(), addMessagesHere);
      });

    })


    :
    fetch(`${messagesPagination.next_page_url}`).then(res => res.json()).then(res => {
      // console.log(res);
      mapMessagesPaginationPagination(res);
      console.log(messagesPagination);
      $('#chatPreloader').remove();
      // res.data = res.data.reverse();
      res.data.forEach(msg => {
        dd.displayMessages(msg, image, $('#authUserImage').val(), addMessagesHere);
      });
    });
  addMessagesHere.append(loader);
}
