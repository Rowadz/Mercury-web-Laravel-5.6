/*eslint no-console: */
import {
  usernamesPagination,
  mapUsernamesPagination,
} from './helpers/usernamesPagination';
import * as dd from './helpers/displayData';
import {
  messagesPagination,
  mapMessagesPaginationPagination
} from './helpers/messagesPagination';
export default function initChat() {
  getUserNames(usernamesPagination);
  addEventListeners();
}



function addEventListeners() {
  $(document).on('click', '[data-user]', function () {
    getMessages($(this).attr('data-user'), $(this).attr('data-image'));
  });
  $('#scrollDisplayUsersHere').scroll(function () {
    if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) getUserNames();
  });
  // displayUsersHere
}

async function getUserNames() {
  let displayUsersHere = $('#displayUsersHere');
  let loadingUsersNames = $('#loadingUsersNames');
  try {
    const names = await fetchNames();
    loadingUsersNames.hide();
    console.log(names); // from here you can go the next 10 users
    mapUsernamesPagination(names);
    console.log(usernamesPagination);
    if (names.data.length === 0) {
      someoneIsShy(displayUsersHere);
    } else {
      displayUsers(names.data, displayUsersHere);
    }
  } catch (error) {
    if (error === 'done') M.toast({
      html: 'No more users'
    });
    else
      M.toast({
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

function getMessages(name, image) {
  const loader = '<div class="progress mt-5" id="chatPreloader"><div class="indeterminate"></div></div>';
  const addMessagesHere = $('#addMessagesHere');
  addMessagesHere.html('');
  addMessagesHere.append(loader);
  fetch(`/user/chat/${name}`)
    .then(res => res.json())
    .then(res => {
      console.log(res);
      mapMessagesPaginationPagination(res);
      console.log(messagesPagination);
      $('#chatPreloader').remove();
      res.data.forEach(msg => {
        dd.displayMessages(msg, image, $('#authUserImage').val(), addMessagesHere);
      });
    })
    // eslint-disable-next-line no-unused-vars
    .catch(err => {
      console.error(err);
      M.toast({
        html: 'Something went wrong while loading the messages, try again later'
      });
    });
}
