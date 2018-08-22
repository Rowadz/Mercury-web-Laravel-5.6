export default function exchangeRequestsInit(){
    exchangeRequestsModalOptionsInit()
    exchangeRequestsLoadMoreButtonInit()
}

function exchangeRequestsModalOptionsInit(){
    $('#exchangeRequestsModalOptions').modal({
        onOpenEnd: () => {
            console.log("exchangeRequestsModalOptions onOpenEnd")
        },
        onCloseEnd: () => {
            console.log("exchangeRequestsModalOptions onCloseEnd")
        }
    })
}

function exchangeRequestsLoadMoreButtonInit(){
    let [,idToSend] = $('.exchangeRequest').last().attr('id').split('-')
    console.log(idToSend)
    $("#exchangeRequestsLoadMoreButton").click(() => {
        $("#exchangeRequestsLoadMoreButton").addClass('disabled')
        axios.post('/exchangeRequest/loadMore', {
            idToSend
        }).then(success => {
            if(success.data.length === 0) {
                M.toast({html: 'No more Data 🐵', classes: 'rounded'})
            } else {
                $("#exchangeRequestsLoadMoreButton").removeClass('disabled')
                idToSend = success.data[success.data.length - 1].id
                appendDataExchangeRequests(success.data)
            }
        }).catch(error => {
            M.toast({html: 'Something went wrong 🤖', classes: 'rounded'})
            $("#exchangeRequestsLoadMoreButton").removeClass('disabled')
            console.log(error)
        })
    })
}

function appendDataExchangeRequests(exchangeRequests){
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
                <a href="/show/post/${exchangeRequest.theOtherPost.id}" target="_blank">
                <i class="material-icons black-text">open_in_new</i>
                </a>
                <a href="#exchangeRequestsModalOptions" class="modal-trigger">
                <i class="material-icons black-text">linear_scale</i>
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
        `)
    })
}