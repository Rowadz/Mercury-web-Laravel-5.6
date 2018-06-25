(()=>{
	// the code here is not loaded 
	// just to return here if anything go wrong
	// the smae code is now in the app.js file
	// under the checkForFollowers function

	const userName =  $("#userNameForCheckNewFollowers").val()
	const endPoint  = `/new/${userName}/followers`
	const dataToSend = {
		userName : userName
	}
	const XcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	const options = {
		endPoint : endPoint,
		dataToSend: dataToSend,
		XcsrfHeaders : XcsrfHeaders
	}
	let followingRequestUpdate = $("#followingRequestUpdate")
	let notificationMenu = $("#notificationMenu")
	notificationMenu.hide()
	checkNewFollowRequest = options => {
			$.ajax({
				url: options.endPoint,
				data:options.dataToSend.userName ,
				method: "POST",
				headers: options.XcsrfHeaders
			}).done((res)=>{
				if(res.newFollowers.length >= 1) {
					const audio = new Audio('/sounds/newFollow.mp3')
                    audio.play()
                    notificationMenu.fadeIn()
				}
				notificationMenu.html(parseInt(notificationMenu.html()) + res.newFollowers.length)
				followingRequestUpdate.html((res.newFollowers.length + res.oldFollowers.length))
			}).fail(()=>{
				// Nothing to to..
			})
	}
 	checkNewFollowRequestTrigger = x =>{
		checkNewFollowRequest(options);
		setTimeout(checkNewFollowRequestTrigger , 20000)
	}
	checkNewFollowRequestTrigger(1)
	
})()