/*eslint no-console: */
let exchangeRequestReverseSortingTurn = 'ASC',
	exchangeRequestReverseSortingTurnClicked = false;
export default function exchangeRequestsInit(){
	exchangeRequestsModalOptionsInit();
	let pages = {
		page: 1
	};
	exchangeRequestsLoadMoreButtonInit(pages);
	$('#exchangeRequestReverseSorting').click(()=>{
		$('#exchangeRequestReverseSorting').hide();
		exchangeRequestReverseSorting(exchangeRequestReverseSortingTurn === 'DESC');
		switch (exchangeRequestReverseSortingTurn) {
		case 'DESC':
			exchangeRequestReverseSortingTurn = 'ASC';
			break;
		case 'ASC':
			exchangeRequestReverseSortingTurn = 'DESC';
		}
	});
}

function exchangeRequestsModalOptionsInit(){
	const axios = window.axios;
	const M = window.M;
	let exchangeRequestsModalOptions = $('#exchangeRequestsModalOptions');
	let exchangeRequestsModalOptionsController = M.Modal.getInstance(exchangeRequestsModalOptions);
	// exchangeRequestsModalOptions.modal({
	//     onOpenEnd: () => {
	//         console.log("exchangeRequestsModalOptions onOpenEnd")
	//     },
	//     onCloseEnd: () => {
	//         console.log("exchangeRequestsModalOptions onCloseEnd")
	//     }
	// })
	let dataToSubmit = undefined;
	$('.modal-trigger-custom').click(e => {
		// console.log(e.target.parentElement)
		let x = e.target.parentElement;
		let z = $(x);
		dataToSubmit = {
			exchangeRequestId: z.data('exchange-request-id'),
			user_post_id: z.data('auth-user-post-id'),
			owner_post_id: z.data('post-id')
		};
		console.log(dataToSubmit);
		// console.log(z.data('exchange-request-id'))
		// console.log(z.attr('data-exchange-request-id'))
		exchangeRequestsModalOptionsController.open();
	});

	$('#acceptExchangeRequestButtonModal').off('click');
	$('#acceptExchangeRequestButtonModal').click(()=>{
		axios.patch('/show/exchangeRequests/accept',{
			exchangeRequestInfo: dataToSubmit
		}).then(success => {
			console.log(success.data);
			M.toast({html: `${success.data.message} 🐵`});
			if(success.data.action === 'refresh')
				window.location.reload(true);
		}).catch(error => {
			console.log(error);
			M.toast({html: 'Something went wrong 🤖', classes: 'rounded'});
		});
	});

	$('#deleteExchangeRequestButtonModal').off('click');
	$('#deleteExchangeRequestButtonModal').click(()=>{
		axios.delete('/show/exchangeRequests/delete', {
			data:{
				exchangeRequestInfo: dataToSubmit
			}
		}).then(success => {
			console.log(success.data);
			M.toast({html: `${success.data.message} 🐵`});
			window.location.reload(true);
		}).catch(error => {
			console.log(error);
			M.toast({html: 'Something went wrong 🤖', classes: 'rounded'});
		});
	});
}

function exchangeRequestsLoadMoreButtonInit(pages){
	const axios = window.axios;
	const M = window.M;
	let [,idToSend] = $('.exchangeRequest').last().attr('id').split('-');
	console.log(idToSend);
	$('#exchangeRequestsLoadMoreButton').click(() => {
		$('#exchangeRequestsLoadMoreButton').addClass('disabled');
		fetch(`/paginate/exchangeRequests?page=${pages.page}`)
			.then(s => s.json())
			.then(x => console.log(x))
			.catch(e => console.error(e));
		axios.post('/exchangeRequest/loadMore', {
			idToSend,
			turn: ((exchangeRequestReverseSortingTurn === 'DESC') && exchangeRequestReverseSortingTurnClicked) ? 'ASC' : 'DESC'
		}).then(success => {
			if(success.data.length === 0) {
				M.toast({html: 'No more Data 🤖', classes: 'rounded'});
			} else {
				$('#exchangeRequestsLoadMoreButton').removeClass('disabled');
				idToSend = success.data[success.data.length - 1].id;
				appendDataExchangeRequests(success.data);
			}
		}).catch(error => {
			M.toast({html: 'Something went wrong 🤖', classes: 'rounded'});
			$('#exchangeRequestsLoadMoreButton').removeClass('disabled');
			console.log(error);
		});
	});
}

function appendDataExchangeRequests(exchangeRequests){
	$('.modal-trigger-custom').off('click');
	exchangeRequests.forEach(exchangeRequest => {
		$('#httpAjaxData').append(`
            <div class="card z-depth-5 exchangeRequest" data-aos="flip-left" id="exchangeRequest-${exchangeRequest.id}">
            <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="${exchangeRequest.theOtherPost.imageLocation}">
            </div>
            <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
                <small class="chip strongChips grey darken-3 blue-text z-depth-5">
                ${exchangeRequest.theOtherPost.header}
                </small>
                <span class="chip strongChips grey darken-4 yellow-text text-accent-1 z-depth-5">
                Sent  @ ${exchangeRequest.created_at}
                </span>
                <p class="flow-text truncate">${exchangeRequest.theOtherPost.body}</p>
                <i class="material-icons right">more_vert</i>
            </span>
            <p>
            <a href="/show/post/${exchangeRequest.theOtherPost.id}" target="_blank" class="btn-floating btn-large deep-purple lighten-4 pulse waves-effect waves-purple">
            <i class="material-icons black-text">open_in_new</i>
           </a>
            <a class="btn-floating btn-large cyan lighten-4 pulse modal-trigger-custom waves-effect waves-red"  data-exchange-request-id="${exchangeRequest.id}" data-auth-user-post-id="${exchangeRequest.post.id}" data-post-id="${exchangeRequest.theOtherPost.id}">
              <i class="material-icons black-text pulse">more_horiz</i>
            </a>
            </p>
            </div>
            <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Your post<i class="material-icons right">close</i></span>
            <div class="card">
                <div class="card-image">
                    <img src="${exchangeRequest.post.imageLocation}">
                    <span class="card-title">
                    <small class="chip strongChips grey darken-4 blue-text z-depth-5">
                    ${exchangeRequest.post.header}
                    </small>
                    </span>
                </div>
                <div class="card-content">
                    <p class="flow-text truncate">${exchangeRequest.post.body}</p>
                </div>
                <div class="card-action">
                    <a href="/show/post/${exchangeRequest.post.id}" target="_blank">
                    <i class="material-icons black-text">open_in_new</i>
                    </a>
                </div>
            </div>
            </div>
        </div>
        `);
	});
	exchangeRequestsModalOptionsInit();
}

function exchangeRequestReverseSorting(ShouldItBeDESC){
	const axios = window.axios;
	const M = window.M;
	exchangeRequestReverseSortingTurnClicked = true;
	$('#exchangeRequestsLoadMoreButton').addClass('disabled');
	// Remove all child nodes from the DOM.
	$('#exchangeRequestsDataSorting').empty();
	$('#exchangeRequestsDataSorting').html(`    
            <div class="preloader-wrapper big active" id="exchangeRequestsDataSortingPreLoader">
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
            <section id="httpAjaxData"></section>
    `);
	axios.get(`/show/exchangeRequests/${ (ShouldItBeDESC) ? 'DESC' : 'ASC' }`)
		.then(success => {
			console.log(success.data);
			appendDataExchangeRequests(success.data);
			$('#exchangeRequestsLoadMoreButton').removeClass('disabled');
			$('#exchangeRequestReverseSorting').removeClass('disabled');
			$('#exchangeRequestsDataSortingPreLoader').remove();
			$('#exchangeRequestsLoadMoreButton').off('click');
			$('#exchangeRequestReverseSorting').fadeIn(2000);
			exchangeRequestsLoadMoreButtonInit();
		}).catch(error => {
			$('#exchangeRequestsDataSortingPreLoader').remove();
			$('#exchangeRequestReverseSorting').removeClass('disabled');
			M.toast({html: 'Something went wrong 🤖', classes: 'rounded'});
			console.log(error);
			$('#exchangeRequestReverseSorting').fadeIn(2000);
		});
}
