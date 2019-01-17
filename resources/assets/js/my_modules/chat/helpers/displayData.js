export const displayUsers = (names, displayUsersHere) => {
  for (const user of names) {
    displayUsersHere.append(`
		<ul class="collection msgUser clickable hoverable mt-0" data-user="${user.name}" data-image="${user.image}">
		<li class="collection-item avatar grey darken-1">
		  <img src="${ user.image }" alt="" class="circle">
		  <time class="title" data-usernamenot="${user.name}">${ user.name}</time>

		  <!-- here number -->
		</li>
	  </ul>
		`);
    // <span class="new badge" data-badge-caption="custom caption">4</span>
  }
};

export const someoneIsShy = displayUsersHere => {
  displayUsersHere.html(`
	<ul class="collection msgUser clickable hoverable mt-0">
	<li class="collection-item avatar grey darken-1">
	  <img src="/images/happy.png" alt="" class="circle">
	  <p class="white-text">
		Someone is shy
	  </p>
	</li>
  </ul>
	`);
};


export const displayMessages = (msg, image, authUserImage, addMessagesHere) => {
  addMessagesHere.append(`
	<div class="row">
	  <ul class="collection z-depth-5 msgBox animated flash ${msg.from_id === +$('#authUserIdForNotify').val() ? 'msgPopUpMe' : 'msgPopUp'}">
		<li class="collection-item avatar  grey darken-4">
		  <img src="${msg.from_id === +$('#authUserIdForNotify').val() ? authUserImage : image}" alt="" class="circle">
		  <time class="title">${msg.created_at}</time>
		  <p>
			${msg.body}
		  </p>
		</li>
	  </ul>
	</div>
		`);
};

export const prependMessage = (msg, image, authUserImage, addMessagesHere) => {
  addMessagesHere.prepend(`
	<div class="row">
	  <ul class="collection z-depth-5 msgBox animated flash ${msg.from_id === +$('#authUserIdForNotify').val() ? 'msgPopUpMe' : 'msgPopUp'}">
		<li class="collection-item avatar  grey darken-4">
		  <img src="${msg.from_id === +$('#authUserIdForNotify').val() ? authUserImage : image}" alt="" class="circle">
		  <time class="title">${msg.created_at}</time>
		  <p>
			${msg.body}
		  </p>
		</li>
	  </ul>
	</div>
		`);
};
