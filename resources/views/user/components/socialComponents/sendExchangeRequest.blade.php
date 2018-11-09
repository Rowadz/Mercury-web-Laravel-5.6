<div id="sendExchangeRequestModal" class="modal  blue-grey darken-4">
  <div class="modal-content white-text">
    <h4>Send Exchange Request</h4>
    <p>Choose on of your posts that you published and they are still available</p>
    <div class="row">
      <div class="input-field col s12 m10">
        <i class="material-icons prefix grey-text text-lighten-3">search</i>
        <input id="searchFilter-postsExchangeRequest" type="text">
        <label for="searchFilter-postsExchangeRequest">Search your posts by header</label>
      </div>
      <div class="input-field col s12 m2">
        <a class="btn-floating  waves-effect waves-light light-blue darken-4" id="searchPostsSendExchangeRequestModal">
          <i class="material-icons">search</i>
        </a>
      </div>
    </div>
    <!-- Your posts -->
    <div class="row" id="addExchangeRequestPostsCards">
    </div>
  </div>
  {{-- <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
  </div> --}}
</div>
