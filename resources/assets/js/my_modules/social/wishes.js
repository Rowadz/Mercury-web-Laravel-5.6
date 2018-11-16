/*eslint no-console: */
let wishedPostsNumber = undefined,
  lowestId = undefined;
export default function wishes() {
  const axios = window.axios;
  $('.seeWishesModal').modal({
    onOpenStart: () => {
      $('#wishesNumberModal').html($('#getWishesNumber').text());
      axios.post('/wishedPosts')
        .then(success => {
          appendData(success.data);
          console.log(success.data)
          wishedPostsNumber = Number($('#getWishesNumber').text());
          if (success.data.length <= 0) lowestId = 0;
          else lowestId = success.data[success.data.length - 1].id;
          // console.log(lowestId)
          $('#Preloader-wishes').remove();
          loadMoreWishes();
        })
        .catch(error => {
          console.log(error);
        });
    },
    onCloseStart: () => {
      $('#modalLoadMore-wishes').off('click');
      $('#modalSection-wishes').html(`
            <!-- PreLoader -->
            <div class="row center-align" id="Preloader-wishes">
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

function appendData(array) {
  let wishesSection = $('#modalSection-wishes');
  array.forEach(wish => {
    wishesSection.append(`
            <div class="col s12 m4" id="wishToDelete-${wish.post.id}">
            <div class="card">
            <div class="card-image">
                <img src="${wish.post.post_images[0].location}">
                <span class="card-title">
                    <div class="chip black white-text">
                        ${wish.post.header}
                    </div>
                </span>
            </div>
            <div class="card-content">
                <p class="truncate">
                    ${wish.post.body}
                </p>
            </div>
            <div class="card-action">
            <div class="row">
                <div class="col s6 m6">
                    <a href="/show/post/${wish.post.id}" target="_blank" class="waves-effect waves-light btn yellow accent-1 black-text">Show</a>
                </div>
                <div class="col s6 m6">
                    <button class="waves-effect waves-light btn red accent-2 deleteWishButton black-text" id="wishToDeleteButton-${wish.post.id}">X</button>
                </div>
              <!--  <div class="col s12 m8">
                    <button class="waves-effect waves-light btn deep-purple lighten-2 black-text">${wish.created_at}</button>
                </div> -->
            </div>
            </div>
            </div>
            </div>
        `);
  });
  $('.deleteWishButton').off('click');
  deleteWish();
}


function deleteWish() {
  const axios = window.axios;
  const M = window.M;
  $('.deleteWishButton').click(el => {
    // console.log(el.target.id)
    let [, postId] = el.target.id.split('-');
    $(`#wishToDeleteButton-${postId}`).addClass('disabled');
    axios.delete(`/deleteWishedPost/${el.target.id}`, {
        data: {
          id: postId
        }
      })
      .then(success => {
        M.toast({
          html: `${success.data.message}`,
          classes: 'rounded'
        });
        updateNumberAndUI(postId);
      })
      .catch(error => {
        console.log(error);
        $(`#wishToDeleteButton-${postId}`).removeClass('disabled');
        M.toast({
          html: 'Something went wrong 🤖',
          classes: 'rounded'
        });
      });
  });
}

function updateNumberAndUI(postId) {
  wishedPostsNumber--;
  $('#wishesNumberModal').html(`${wishedPostsNumber}`);
  $('.updateWishesNumber').html(`${wishedPostsNumber}`);
  $(`#wishToDelete-${postId}`).slideUp().remove();
}


function loadMoreWishes() {
  const axios = window.axios;
  const M = window.M;
  $('#modalLoadMore-wishes').click(() => {
    $('#modalLoadMore-wishes').addClass('disabled');
    axios.post('/wishedPosts', {
        lowestId: lowestId
      })
      .then(success => {
        console.log(success.data);
        console.log(lowestId);
        $('#modalLoadMore-wishes').removeClass('disabled');
        appendData(success.data);
        lowestId = success.data[success.data.length - 1].id || null;
      })
      .catch(err => {
        console.log(err);
        M.toast({
          html: 'No More Data 🤖',
          classes: 'rounded'
        });
        $('#modalLoadMore-wishes').remove();
      });
  });
}
