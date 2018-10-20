/*eslint no-console: */
let postId = $('#postId').val(),
	postActions = $('#postActionsWishUnWish');

export default function postFunctions(){
	// added addPostToWishList outside the Vue instance because 
	// Some wired Error 
	$('#addToWishListButton').on('click', () => {
		//  console.log("addToWishListButton")
		addRemoveFromWishList(postId, 'addToWishList', 'addToWishListButton');
	});
	$('#deletePostFromWithListButton').on('click', () => {
		//  console.log("deletePostFromWithListButton")
		addRemoveFromWishList(postId, 'deleteWishedPost', 'deletePostFromWithListButton');
	});
	addCommentInit();
	addCommentViaTheButton();
}
function addRemoveFromWishList(id, endPoint, targetSelection){
	const axios = window.axios;
	const M = window.M;
	$(`#${targetSelection} > a`).addClass('disabled');
	$(`#${targetSelection}`).off('click');
	axios.post(`/${endPoint}/${id}`, {
		id: id
	}).then(success => {
		$(`#${targetSelection}`).remove();
		switchAddNRemove(endPoint === 'addToWishList');
		M.toast({html: `${success.data.message} 🐵`});
		updateWishNumbersUI(endPoint === 'addToWishList');
	}).catch(error => {
		$(`#${targetSelection}`).removeClass('disabled');
		console.log(error);
		M.toast({
			html: 'Something went wrong 🤖',
			classes: 'red accent-3'
		});
	});
}
function switchAddNRemove(actionAdd){
	if(actionAdd){
		postActions.append(`
            <li id="deletePostFromWithListButton">
                <a class="btn-floating red tooltipped"  data-position="left" data-tooltip="Already Saved">
                    <i class="material-icons">bookmark</i>
                </a>
            </li>
        `);
		$('#deletePostFromWithListButton').on('click', () => {
			// console.log("deletePostFromWithListButton After")
			addRemoveFromWishList(postId, 'deleteWishedPost', 'deletePostFromWithListButton');
		});
	}else {
		postActions.append(`
        <li id="addToWishListButton">
            <a class="btn-floating red tooltipped" data-position="left" data-tooltip="Click Here to add post to wish list">
                <i class="material-icons">bookmark_border</i>
            </a>
        </li>
    `);
		$('#addToWishListButton').on('click', () => {
			// console.log("addToWishListButton After")
			addRemoveFromWishList(postId, 'addToWishList', 'addToWishListButton');
		});
	}

	reInitFloatingButtonAndToolTips();
}

function reInitFloatingButtonAndToolTips(){
	$('.fixed-action-btn').floatingActionButton();
	$('.tooltipped').tooltip();
}

function addCommentInit(){
	let commentInput = $('#commentInput');
	commentInput.keyup((e)=>{
		if(e.ctrlKey && e.keyCode === 13){
			// console.log("Submit the comment", commentInput.val())
			submitComment(commentInput.val());
		}else if(e.keyCode === 13){
			// console.log("NEW LINE !",  commentInput.val())
		}
	});

}

function addCommentViaTheButton(){
	$('#addCommentButton').click(()=>{
		submitComment();
	});
}

function submitComment(comment = undefined){
	const axios = window.axios;
	const M = window.M;
	let theComment = undefined;
	if (typeof comment === 'undefined') theComment = $('#commentInput').val();
	else theComment = comment;
	theComment = filterTheDataBeforeSubmit(theComment);
	if(theComment.length){
		axios.post(`/post/${postId}/addComment`, {
			comment: theComment,
			postId: postId
		}).then(success => {
			M.toast({html: `${success.data.message} 🐵`});
			removeCommentValue();
		}).catch(error => { 
			console.log(error);
			M.toast({
				html: 'Something went wrong 🤖',
				classes: 'red accent-3'
			});
		});
	} else M.toast({html: 'Something went wrong 🤖'});

}

function filterTheDataBeforeSubmit(comment){
	comment = comment.trim().replace(/(<([^>]+)>)/ig, '');
	return comment;
}

function removeCommentValue(){
	$('#commentInput').val('');
}

function updateWishNumbersUI(increase){
	let wishedPostsNumber = Number($('#getWishesNumber').text());
	if(increase){
		wishedPostsNumber++;
		$('#wishesNumberModal').html(`${wishedPostsNumber}`);
		$('.updateWishesNumber').html(`${wishedPostsNumber}`);
	} else {
		wishedPostsNumber--;
		$('#wishesNumberModal').html(`${wishedPostsNumber}`);
		$('.updateWishesNumber').html(`${wishedPostsNumber}`);
	}
}