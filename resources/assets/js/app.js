/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
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
    // if($('img').length) handleImageLoading()
    handleImageLoading()
})()


// execute when the page loads
window.onload = () => {
    // if ($("#userNameForCheckNewFollowers").length) checkForFollowers()
    if ($("#feed").length) feed()
    init()
    if($("#followingRequests").length) approveDeclineFollow()
    // if the image did not load  (Broken Image Handling)
    if($("#whishedPosts").length) deleteAWish()
    if($('img').length) handleImageLoading()
    $('.sidenav').sidenav()
    // init the navbar
    $(".dropdown-trigger").dropdown({
        constrainWidth: false,
        onCloseStart : () => {
            $('.card').css('z-index', 1)
            $('.card-title').css('z-index', 1)
            $('.postImage').css('z-index', 1)
            $('.parallax-container').css('z-index', 1)
        }
    });
    if($('.mainResgister').length) initSignUp()
    $('.tooltipped').tooltip()
    $('.fixed-action-btn').floatingActionButton()
    $('.materialboxed').materialbox()
    clickStuff()
    overFlow()
    $('.modal').modal()
    $('.parallax').parallax()
    $('select').formSelect()
    if($('#sortPostsUserProfile').length) initSortingForProfile()
}

function initNavbar(){
    $('.sidenav').sidenav()
    // M.toast({html: '🤖 Welcome humnan 🤯 🤖'})
}

const overFlow = () => {
    // the li that opens the dropdown list in the navbar
    $("#fixOverFlowIssue").click(()=>{
        $('.card').css('z-index',-1)
        $('.chip').css('z-index', 1)
        $('.postImage').css('z-index', -1)
        $('.parallax-container').css('z-index', -1)
    })
}
const clickStuff = () => {
    $('#scrollTop').click(()=>{
        $('html, body').animate({
            scrollTop: $("#feed").offset().top
        }, 1000);
    })
}

const initSignUp = () => {
    $('select').formSelect()
    $('.datepicker').datepicker()
}

const init = () => {
    AOS.init()
}

const feed = () => {
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
            brokenImageHandling(image){
                image.src = "/images/404.png"
                // $('.faildToLoadImage').show()
                this.removeLoader()
            },
            removeLoader(){
                $(".imageLoader").hide()
            },
            removeSpecificLoader(id){
                console.log(`imageLoader${id}`)
                $(`.imageLoader${id}`).hide()
            },
            loadMorePosts(){
                // console.log('@click="loadMorePosts')
                $("#dimmerHere").html(`
                        <div class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                        </div>
                    </div>
                `)
                $('#dimmerImage').removeClass(`
                    scale-out
                `)
                $('#dimmerImage').removeClass(`
                    scale-in
                `)
                $('#dimmerImage').addClass(`
                    scale-out
                `)
                let url = null
                if($("#feedNoAuth").length)  url = '/show/all/postsNoAuth'
                else if($('#profile').length) url = '/show/user/posts/profile'
                else  url = '/home/loadMorePosts'
                axios.post(url, {
                    lastId: this.lastId,
                    userId : ($('#userIdProfile').length) ? $('#userIdProfile').val() : null
                })
                    .then((response) => {
                        $("#dimmerHere").html("More")
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
                        $('#dimmerImage').addClass(`
                             scale-in
                        `)
                        audio.play()
                    })
                    .catch((error) => {
                        let audio = new Audio('/sounds/Lightsaber_Turn_Off.mp3')
                        audio.play()
                        $('#dimmerImage').attr("src", "/images/404.png")
                        $('#dimmerImage').addClass(`
                            scale-in
                        `)
                        $("#dimmerHere").html(`🤖`)
                    })
            }
        }
    })
}


// emojis does not work with Vue 
// that's why there is a function outside the Vue instance
const getEmoji = (emoji) => {
    let commentText = document.getElementById("commentInput")
    console.log(commentText.value, emoji.innerHTML)
    commentText.value = commentText.value +  emoji.innerHTML
}



function post(){

     addPostToWishList = id => {
        axios.post(`/post/add-to-wish-list/${id}`, {
            id: id
        }).then(res => {
            // console.log(res.data)
            let addToWishListButton = $("#addToWishListButton")
            addToWishListButton.addClass("disabled")
            addToWishListButton.html(`<i class="bookmark icon"></i> `)
            $("#addToWishListText").html("The post Added to your wish list")
            M.toast({
                html: res.data.message,
                classes: (res.data.message === "You just saved this post !") ?  'light-blue darken-3' :  'deep-purple darken-2'
            })
        })
            .catch(err => {
                M.toast({
                    html: 'Something went wrong',
                    classes: 'red accent-3'
                })
            })
    }


    const post = new Vue({
        el: "#post",
        data: {
            postId: $("#postId").val(),
            loadedComments: null,
            comment: ''
        },
        methods: {
            // Vue Two way binding did't work with the emoji lib.
            // this is why is use jquery here!
            addComment(){
                let comment = this.comment
                let userName = $("#userName").val()
                let userImage = $("#userImage").val()
                if (comment.length === 0 || comment.trim().length === 0) {
                    M.toast({
                        html: 'Add Some Text, NO white space!',
                        classes: 'red accent-1'
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
                        M.toast({
                            html: res.data.message,
                            classes: 'blue accent-2'
                        })
                        $("#addMoreCommentsHere").append(`
                        <div class="col s12 m6" data-aos="zoom-in">
                            <ul class="collection">
                                <li class="collection-item avatar  z-depth-5 white-text blue-grey darken-3">
                                <img src="${userImage}" alt="user image" class="circle  z-depth-5">
                                    <span class="title">
                                        <strong class="usernameComment">
                                            🐻  ${ userName } 
                                        </strong>
                                    </span>
                                    <p> 
                                        <small class="commentDate">
                                            📆 Just now!
                                        </small>
                                    <br><br>
                                            ${ comment }
                                    </p>
                                    <a href="/${userName}" class="secondary-content"><i class="material-icons">person_outline</i></a>
                                </li>
                            </ul>
                        </div>
                        `)
                        this.comment = ''
                    }).catch(err => {
                        M.toast({
                            html: 'Something went wrong, try again',
                            classes: 'red accent-2'
                        })
                    })
                }
                //console.log({comment: $("#commentTextarea").val(), postId: this.postId})
            },
        },

    })
}


// This is lexical scoping, which describes how a parser resolves variable names when functions are nested. 
// The word "lexical" refers to the fact that lexical scoping uses the location where a variable is declared within the source code to determine where that variable is available.
// Nested functions have access to variables declared in their outer scope.

// checkForFollowers = () => {
//     const userName =  $("#userNameForCheckNewFollowers").val()
// 	const endPoint  = `/new/${userName}/followers`
// 	const dataToSend = {
// 		userName : userName
// 	}
// 	const XcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
// 	const options = {
// 		endPoint : endPoint,
// 		dataToSend: dataToSend,
// 		XcsrfHeaders : XcsrfHeaders
// 	}
// 	let followingRequestUpdate = $("#followingRequestUpdate")
// 	let notificationMenu = $("#notificationMenu")
// 	notificationMenu.hide()
// 	checkNewFollowRequest = options => { // checkNewFollowRequest() inner function, a closure
// 			$.ajax({
// 				url: options.endPoint,
// 				data:options.dataToSend.userName ,
// 				method: "POST",
// 				headers: options.XcsrfHeaders
// 			}).done((res)=>{
// 				if(res.newFollowers.length >= 1) {
// 					const audio = new Audio('/sounds/newFollow.mp3')
//                     audio.play()
//                     notificationMenu.fadeIn()
// 				}
// 				notificationMenu.html(parseInt(notificationMenu.html()) + res.newFollowers.length)
// 				followingRequestUpdate.html((res.newFollowers.length + res.oldFollowers.length))
// 			}).fail(()=>{
// 				// Nothing to to..
// 			})
// 	}
//  	checkNewFollowRequestTrigger = x =>{ // checkNewFollowRequestTrigger() inner function, a closure
// 		checkNewFollowRequest(options);
// 		setTimeout(checkNewFollowRequestTrigger , 20000)
// 	}
// 	checkNewFollowRequestTrigger(1)
// }

// Dead Code !
const approveDeclineFollow = ()=>{
    const approveEndPoint = "/approve/follow"
	const declineEndPoint = "/decline/follow"
	const xcsrfHeaders = {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	
	const approve = id =>{ // approve() inner function, a closure
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

	const decline = id => { // decline() inner function, a closure
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

function handleImageLoading(){
    const  brokenImageHandling = (image) => {
        image.src = "/images/404.png"
        // $('.faildToLoadImage').show()
        removeLoader()
    }
    
    const  removeLoader = () => {
        $(".imageLoader").hide()
    }
    // removeSpecificLoader = (id) => $(`.imageLoader${id}`).hide()
}
function profile(){
    if($('#sendConfirmed').length) {
        $('#sendConfirmed').click(()=>{
            $('#sendConfirmed').addClass('disabled')
        })
    }
    if($('#cancelConfirmed').length) {
        $('#cancelConfirmed').click(()=>{
            $('#cancelConfirmed').addClass('disabled')
        })
    }
    if($('#unFollowConfirmed').length) {
        $('#unFollowConfirmed').click(()=>{
            $('#unFollowConfirmed').addClass('disabled')
        })
    }
}

const deleteAWish = () =>{
    const deleteWish = id => { // deleteWish() inner function, a closure
        axios.post(`/user/delete-wished-post/${id}`, {
            id:id
        }).then(res => {
            $(`#${id}`).fadeOut()
            iziToast.success({
                title: 'OK',
                message: res.data.success
            })
        }).catch(() => {
            iziToast.error({
                title: 'OK',
                message: "Something went wrong!"
            })
        })
    }
}

initSortingForProfile = () =>{
    // for page showUserPosts
    let x =  document.getElementById('sortingForm')
    let sortUrl = {
        sortOption: 'Descending',
        postsType: 'Available',
        formAction: (typeof(x) !== 'undefined' && x !== null) ? document.getElementById('sortingForm').action : null
    }
    $('#sortOption').change(()=>{
        let selectedOption = $('#sortOption option:selected').val()
        sortUrl.sortOption = selectedOption
    })
    $('#postsType').change(()=>{
        let selectedOption = $("#postsType option:selected").val()
        sortUrl.postsType = selectedOption
    })

    $('#sortPostsUserProfileButton').click(()=>{
        let sortingForm = document.getElementById('sortingForm')
        sortingForm.action = `${sortUrl.formAction}${sortUrl.sortOption}N${sortUrl.postsType}/`
        sortingForm.submit()
    })

}
