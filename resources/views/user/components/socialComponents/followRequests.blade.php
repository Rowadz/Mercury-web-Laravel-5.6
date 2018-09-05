 <!-- follow requests modal fullScreenModal  -->
 <div id="followRequestsModal" class="modal  blue-grey darken-3 followRequestsModal ">
    <div class="row paddingSocial">
      <div class="col s12 m6 white-text">
          <p class="hide-on-small-only">Press <span class="red-text">Esc</span> To go back or the X Button</p>
      </div>
      <div class="col s12 m6">
          <a class="btn-floating waves-effect waves-light deep-orange accent-4 z-depth-5  modal-close floatRight">
            <i class="material-icons">close</i>
          </a>
      </div>
    </div>
    <div class="row">
        <div class="input-field col s12 m12">
            <i class="material-icons prefix grey-text text-lighten-3">search</i>
            <input id="searchFollowRequests" class="white-text" type="text">
            <label for="searchFollowRequests">Filter by first name</label>
          </div>
      </div>    
        <div class="modal-content white-text">
          <h4 id="numberOfFollowRequests">Follow requests</h4>
          <div class="row">
          <section id="usersRequestedToFollowYou">
            <div class="row center-align">
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
            </div>
          </section>
        </div>
        </div>
        <!--
        <div class="modal-footer blue-grey darken-4">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat white-text">Dismiss</a>
        </div>
      -->
      </div>