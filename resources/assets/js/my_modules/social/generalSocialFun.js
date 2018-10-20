// This code works for the Followers Modal & the Following modal with no duplicated code !
/*eslint no-console: */

let highestId = undefined,
	arrayToFindHighestId = [],
	sectionToAddData = undefined,
	targetSelection = undefined,
	endPoint = undefined;
    
export default function generalSocialFun(endPointArg, modalClass, sectionIDToLoadData, totalModalNumber, navBarTargetNumber, targetSelectionArg){
	const axios = window.axios;
	const M = window.M;
	sectionToAddData = $(`#${sectionIDToLoadData}`);
	targetSelection = targetSelectionArg;
	endPoint = endPointArg;
	$(`.${modalClass}`).modal({
		onOpenStart: () => {
			$(`#${totalModalNumber}`).html($(`#${navBarTargetNumber}`).text());
			highestId = undefined;
			arrayToFindHighestId = undefined;
			axios.post(endPoint)
				.then(success => {
					// console.log(success.data)
					appendData(success.data);
					searchFilter();
					arrayToFindHighestId = success.data;
					addEventListenerOnLoadMoreButton();
				})
				.catch(error => {
					console.log(error);
					M.toast({html: 'Something went wrong 🤖', classes: 'rounded red lighten-2'});
				});
		},
		onCloseStart: () => {
			highestId = undefined;
			arrayToFindHighestId = undefined;
			// removing the event handler on the load more button 
			// beacuse the function that add an event listener will be triggerd each time 
			// the user opens the modal, this will cause calling the endpoint one more time on each open !
			$(`#modalLoadMore-${targetSelection}`).off('click');
			sectionToAddData.html(`
            <!-- PreLoader -->
            <div class="row center-align" id="Preloader-${targetSelection}">
                <div class="preloader-wrapper big active ">
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
            </div>
            
            <!-- End PreLoader -->
            `);
		}
	});
}

function searchFilter(){
	let Names = [];
	$('.seacrhFilterBasedOnName').each(function(position, element){
		Names.push(element.innerHTML);
	});

	$(document).on('keyup', `#searchFilter-${targetSelection}`, function(){
		let input = $(`#searchFilter-${targetSelection}`);
		Names.forEach(name => {
			let x = name.toUpperCase(),
				y = input.val().toUpperCase(),
				theUserToFind = sectionToAddData;
			if((x.indexOf(y) > -1 ) && input.val() ) {
				// console.log(`${name} !== ${$('#searchFollowRequests').val()}`) 
				theUserToFind.find(`li[data-username='${name}']`).fadeIn();
			}else if(! input.val() ){
				theUserToFind.find(`li[data-username='${name}']`).fadeIn();
			}else {
				theUserToFind.find(`li[data-username='${name}']`).fadeOut();
			}
		});
	});

}


// if you this function multiple times you will add multiple eventListeners !!!
function addEventListenerOnLoadMoreButton(){
	const axios = window.axios;
	const M = window.M;
	let loaderButton = $(`#modalLoadMore-${targetSelection}`);
	loaderButton.click(()=>{
		if(arrayToFindHighestId.length !== 0){
			if(arrayToFindHighestId.length !== 1)
				highestId = arrayToFindHighestId.reduce((prev, curr) => prev.id > curr.id ? prev.id : curr.id);
			else highestId = arrayToFindHighestId[0].id;

			// console.log(highestId)
			// console.log(arrayToFindHighestId)
			loaderButton.addClass('disabled');
			axios.post(endPoint, {
				highestId : highestId
			})
				.then(success => {
					// console.log(success.data)
					if(success.data.length !== 0)  appendData(success.data);
					else M.toast({html: 'No More Data 🤖'});
					loaderButton.removeClass('disabled');
					arrayToFindHighestId = success.data;
				})
				.catch(error => {
					console.log(error);
					loaderButton.removeClass('disabled');
					M.toast({html: 'Something went wrong 🤖', classes: 'rounded red lighten-2'});
				});
		}else {
			M.toast({html: 'No More Data 🤖'});
		}
	});
	// loaderButton.on('click', () => {
 
	// })
}

function appendData(array){
	let users = array;
	$(`#Preloader-${targetSelection}`).hide();
	users.forEach(aUser => {
		sectionToAddData.append(`
            <li class="collection-item avatar z-depth-5 commentCollectionRemoveUl hoverable marginSocial col s12 m4" data-username="${aUser.user.name}">
                <img src="${aUser.user.image}" alt="user image" class="circle">
                <span class="title seacrhFilterBasedOnName">${aUser.user.name}</span>
                <p>Follower Since: <br>
                  <span class="light-blue-text text-darken-3">  ${aUser.updated_at} </span>
                </p>
                <a href="/${aUser.user.name}" class="secondary-content"><i class="material-icons">account_box</i></a>
            </li>
        `);
	});
	searchFilter();
}

