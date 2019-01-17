import {
  applicationHeaders
} from '../../helpers/headers';
import * as dd from '../helpers/displayData';

/*eslint no-console: */
export function sendMessageInit(selectedChatInfo) {
  localStorage.setItem('userChat', JSON.stringify(selectedChatInfo));
  const messageTextarea = $('#messageTextarea');
  messageTextarea.off('keyup');
  $(document).off('keyup', messageTextarea);
  $(document).on('keyup', messageTextarea, e => {
    if (e.keyCode === 13 && selectedChatInfo) {
      if (messageTextarea.val().trim() === '') return;
      submitMessage(selectedChatInfo, messageTextarea.val());
      messageTextarea.val('');
    }
  });
}

function submitMessage(selectedChatInfo, messageTextarea) {
  fetch('/message', {
      headers: applicationHeaders,
      method: 'POST',
      body: JSON.stringify({
        username: selectedChatInfo.username,
        body: messageTextarea
      })
    }).then(res => res.json())
    // eslint-disable-next-line no-unused-vars
    .then(res =>
      dd.prependMessage(res, selectedChatInfo.image, $('#authUserImage').val(), $('#addMessagesHere'))
    )
    // eslint-disable-next-line no-unused-vars
    .catch(err => {
      M.toast({ // eslint-disable-line
        html: 'Oops!, Something went wrong.'
      });
    });
}
