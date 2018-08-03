 <!-- follow requests modal  -->
 <div id="followRequestsModal" class="modal blue-grey darken-3 followRequestsModal">
    <div class="row">
        <div class="input-field col s12 m12">
            <i class="material-icons prefix grey-text text-lighten-3">search</i>
            <input id="searchFollowRequests" type="text">
            <label for="searchFollowRequests">Filter by first name</label>
          </div>
      </div>    
        <div class="modal-content white-text">
          <h4 id="numberOfFollowRequests">Follow requests</h4>
          <section id="usersRequestedToFollowYou">

              <div class="preloader-wrapper big active" id="preloaderfollowRequestsModal">
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
              
          </section>
        </div>
        <div class="modal-footer blue-grey darken-4">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat white-text">Dismiss</a>
        </div>
      </div>