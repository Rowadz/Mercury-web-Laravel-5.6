import {
  applicationHeaders
} from '../../helpers/headers';
import * as dd from '../helpers/displayData';

/*eslint no-console: */
export function sendMessageInit(selectedChatInfo) {
  console.log(selectedChatInfo);
  const messageTextarea = $('#messageTextarea');
  $(document).on('keyup', messageTextarea, e => {
    console.log(selectedChatInfo);
    if (e.keyCode === 13 && selectedChatInfo) submitMessage(selectedChatInfo, messageTextarea.val());

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
