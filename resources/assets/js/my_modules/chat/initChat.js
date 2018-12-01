/*eslint no-console: */
export default function initChat() {
  addEventListeners();
}



function addEventListeners() {
  $('[data-user]').on('click', function () {
    getMessages($(this).attr('data-user'));
  });
}


function getMessages(name) {
  const loader = '<div class="progress mt-5" id="chatPreloader"><div class="indeterminate"></div></div>';
  const addMessagesHere = $('#addMessagesHere');
//   const user = $('#chat').attr('data-authuser');
  const userId = $('#chat').attr('data-authuserid');
  addMessagesHere.html('');
  addMessagesHere.append(loader);
  fetch(`/user/chat/${name}`)
    .then(res => res.json())
    .then(res => {
      $('#chatPreloader').remove();
      res.messages.forEach(msg => {
        console.log(msg);
		addMessagesHere.append(`
					<div class="card-panel teal animated flash ${msg.from_id === +userId ? '' : ''}" >
						<span class="white-text">
							${msg.from_id === +userId ? '' : name + ' : '} 
						</span>
						<span class="black-text">
							${msg.body}
						</span>
					</div>
			`);
      });
    })
    // eslint-disable-next-line no-unused-vars
    .catch(err => {
      const M = Window.M;
      M.toast({
        html: 'Something went wrong while loading the messages, try again later'
      });
    });
}
