/**
  * Created by LT on 19/05/2018.
*/

// init function should always run before anything so the website won't appear frozened
// execute before the page load ( for slow images )
// so the user can comment before the images loads 
// in case they take long time
(()=>{
    initNavbar()
    if ($("#post").length) post()
    if($("#profile").length) profile()
})()


// execute when the page loads
window.onload = () => {
    if ($("#userNameForCheckNewFollowers").length) checkForFollowers()
    if ($("#feed").length) feed()
    initPopUps()
    if($("#followingRequests").length) approveDeclineFollow()
    // if the image did not load  (Broken Image Handling)
}

function initNavbar(){
    const sideMenu = $("#menuPopUp")
    sideMenu.click(() => {
        $('.ui.sidebar').sidebar('toggle')
    })
    $("#notificationMenu").hide()
}

initPopUps = () => {
    const sideMenu = $("#menuPopUp")
    $("#homePopUp").popup()
    $("#searchPopUp").popup({
        on: 'focus'
    })
    sideMenu.popup()
    $("#postStatusIsOne").popup({
        on: 'hover',
        position   : 'bottom left'
    })
    $("#postStatusIsZero").popup({
        on : 'hover',
        position: 'bottom left'
    })
    $("#notificationMenu").popup({
        on: 'hover',
    })
    // the place of this might change
    $("#Philadelphia").click(()=>{
        $('.ui.modal').modal('show')
    })
    // the place of this might change
    $('.ui.rating').rating()
}

feed = () => {
    const x = new Vue({
        el: "#feed",
        data: {
            posts: [],
            lastId: $("#lastId").val(),
            counter : 0,
            commentNumber : [],
            tagNames: [],
            users: [],
            imageLocation: []
        },
        methods: {
            loadMorePosts(){
                $("#dimmerHere").html(`
                    <div class="ui active  dimmer">
                       <div class="ui text loader">Loading</div>
                    </div>
                    <p></p>
                `)
                let url = null
                if($("#feedNoAuth").length)  url = '/show/all/postsNoAuth'
                else  url = '/home/loadMorePosts'
                axios.post(url, {
                    lastId: this.lastId
                })
                    .then((response) => {
                        $("#dimmerHere").html("<p>Press Here to load more posts</p>")
                        //console.log(typeof (response.data.posts))
                        let allPosts = response.data.posts
                        let x = allPosts.length
                        for(let i = 0; i < x; i++) this.posts.push(allPosts[i])
                        // console.log(this.posts)
                        let allCommentNumber = response.data.commentNumber
                        x = allCommentNumber.length
                        for(let i = 0; i < x; i++) this.commentNumber.push(allCommentNumber[i])
                        //this.commentNumber = response.data.
                        allTagsNames = response.data.tagNames
                        x =  allTagsNames.length
                        for(let i = 0; i < x; i++) this.tagNames.push(allTagsNames[i])
                        users = response.data.users
                        x =  users.length
                        for(let i = 0; i < x; i++) this.users.push(users[i])
                        //this.tagNames = response.data.tagNames
                        imageLocation = response.data.imageLocation
                        x = imageLocation.length
                        for(let i = 0; i < x; i++) this.imageLocation.push(imageLocation[i])
                        this.lastId = allPosts[allPosts.length -1 ].id
                        //console.log(this.lastId)
                        $('#dimmerImage').attr("src", "/images/returnHome.png")
                        let audio = new Audio('/sounds/service-bell_daniel_simion.mp3')
                        audio.play()
                    })
                    .catch((error) => {
                        let audio = new Audio('/sounds/Lightsaber_Turn_Off.mp3')
                        audio.play()
                        $('#dimmerImage').attr("src", "/images/404.png")
                        $("#dimmerHere").html(`
                           <h1>OOps! 😣😣</h1>
                          <p>🤔Something bad happened press again🤔</p>
                                `)
                    })
            }
        }
    })
}

function post(){
    const post = new Vue({
        el: "#post",
        data: {
            postId: $("#postId").val(),
            loadedComments: null,
            comment: ''
        },
        methods: {
            addPostToWishList(id){
                axios.post(`/post/add-to-wish-list/${id}`, {
                    id: id
                }).then(res => {
                    // console.log(res.data)
                    let addToWishListButton = $("#addToWishListButton")
                    addToWishListButton.addClass("disabled")
                    addToWishListButton.html(`<i class="bookmark icon"></i> `)
                    $("#addToWishListText").html("The post Added to your wish list")
                    iziToast.success({
                        title: 'OK',
                        message: res.data.success
                    })
                })
                    .catch(err => {
                        iziToast.error({
                            title: 'Error',
                            message: "Something Went Wrong!"
                        })
                    })
            },
            // Vue Two way binding did't work with the emoji lib.
            // this is why is use jquery here!
            addComment(){
                let comment = this.comment
                let userName = $("#userName").val()
                let userImage = $("#userImage").val()
                if (comment.length === 0 || comment.trim().length === 0) {
                    iziToast.error({
                        title: 'Error',
                        message: "Add Some Text, NO white space!"
                    })
                } else {
                    comment = comment.trim()
                    userName = userName.trim()
                    userImage = userImage.trim()
                    comment = comment.replace(/(<([^>]+)>)/ig,"")
                    userName = userName.replace(/(<([^>]+)>)/ig,"")
                    userImage = userImage.replace(/(<([^>]+)>)/ig,"")
                    axios.post(`/post/${this.postId}/addComment`, {
                        comment: comment,
                        postId: this.postId
                    }).then(res => {
                        iziToast.success({
                            title: 'Success',
                            message: res.data.Success
                        })
                        $("#addMoreCommentsHere").append(`
                                                    <div class="comment">
                        <a class="avatar">
                            <img src="${userImage}">
                        </a>
                        <div class="content">
                            <a class="author"
                               href="/@/${userName}">${userName}</a>
                            <div class="metadata">
                                <div class="date">Just now!</div>
                            </div>
                            <div class="text">
                                    ${comment}
                            </div>
                        </div>
                    </div>
                        `)
                        this.comment = ''
                    }).catch(err => {
                        iziToast.error({
                            title: 'Error',
                            message: "something went wrong"
                        })
                    })
                }
                //console.log({comment: $("#commentTextarea").val(), postId: this.postId})
            },
        },

    })
}

checkForFollowers = () => {
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
}

approveDeclineFollow = ()=>{
    const approveEndPoint = "/approve/follow"
	const declineEndPoint = "/decline/follow"
	const xcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	
	approve = id =>{
		$.ajax({
			url : approveEndPoint,
			data: {
				id: id
			},
			method: "POST",
			headers: xcsrfHeaders
		}).done(res => {
			if(res === "Approved!"){
                iziToast.success({
                    title: 'Success',
                    message: res,
                })
                let followCard = $(`#followCard${id}`)
                followCard.hide()
             }else{
                iziToast.error({
                    title: 'Error',
                    message: `${res} 🤷`,
                })
            }
		})
		.fail(err => {
			iziToast.error({
    			title: 'Error',
    			message: 'Something Went Wrong 🤷',
			})
		})
	}

	decline = id => {
		$.ajax({
			url : declineEndPoint,
			data: {
				id: id
			},
			method: "POST",
			headers: xcsrfHeaders
		}).done(res => {
            if (res === "Declined!") {
    			iziToast.success({
                    title: 'Success',
                    message: res,
                })              
                let followCard = $(`#followCard${id}`)
                followCard.hide()  
            } else {
                iziToast.error({
                    title: 'Error',
                    message: `${res} 🤷`,
                })
            }
		})
		.fail(err => {
			iziToast.error({
    			title: 'Error',
    			message: 'Something Went Wrong 🤷',
			})
		})
	}
}

brokenImageHandling = (image) => {
    image.src = "/images/404.png"
    $('.faildToLoadImage').show()
    removeLoader()
}

removeLoader = () => {
    $("#imageLoader").hide()
}

function profile(){
    const xcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	const endPoints = {
        unFollow : 'unFollow',
        follow: 'follow',
        cancel : 'cancel'
    }
	unFollow = id =>{
        alert(`unFollow row ${id}`)
    }
    
    cancel = () => {

        $('#cancelModal')
        .modal({
            closable  : true,
            onDeny    : function(){
                return 
            },
            onApprove : function() {
              // TODO :: Submit a form that cancel the request !
              $("#cancelForm").submit()
            }
          })
          .modal('show')
        
    }

    follow = id => {
        alert(`follow with id =>  ${id}`)
    }
}