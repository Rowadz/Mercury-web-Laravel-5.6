import {
  applicationHeaders
} from '../../helpers/headers';

function profileMessageInit() {
  $('#sendMessageFromProfile').click(() => {
    const body = $('#messageFromProfile').val();
    if (body.trim('') === '') return;
    const userProfileId = $('#userProfileId').val();
    submitMessage(userProfileId, body);
  });
}


function submitMessage(userProfileId, body) {
  fetch('/message', {
      headers: applicationHeaders,
      method: 'POST',
      body: JSON.stringify({
        userId: userProfileId,
        body
      })
    }).then(res => res.json())
    // eslint-disable-next-line no-unused-vars
    .then(res =>
      M.toast({ // eslint-disable-line
        html: 'message sent'
      })
    )
    // eslint-disable-next-line no-unused-vars
    .catch(err => {
      M.toast({ // eslint-disable-line
        html: 'Oops!, Something went wrong.'
      });
    });
}

export {
  profileMessageInit
};
