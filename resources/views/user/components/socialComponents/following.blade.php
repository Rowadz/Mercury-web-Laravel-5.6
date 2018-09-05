    <!-- fullScreenModal -->
    <div id="followingModal" class="modal  grey darken-3 seeFollowingModal">
        <div class="fixed-action-btn">
            <button class="btn-floating amber lighten-2 z-depth-5 waves-effect waves-purple" id="modalLoadMore-following">
              <i class="large material-icons">call_received</i>
            </button>
        </div>
        <div class="row paddingSocial">
            <div class="col s12 m6 white-text">
                <p class="hide-on-small-only">Press <span class="red-text">Esc</span> To go back or the X Button</p>
            </div>
            <div class="col s12 m6">
                <a class="btn-floating waves-effect waves-light deep-orange accent-4 z-depth-5 modal-close floatRight">
                  <i class="material-icons">close</i>
                </a>
            </div>
              <div class="input-field col s12 m12">
                  <i class="material-icons prefix grey-text text-lighten-3">search</i>
                  <input id="searchFilter-following" class="white-text" type="text">
                  <label for="searchFilter-following">Filter by first name</label>
                </div>
            </div> 
      <div class="modal-content">
        
        <div class="row cyan-text text-lighten-1">
            <h4>
              People you are following
              <span id="followingNumberModal" class="userInfoRevealCardMailTitle">
                <!-- following number -->
              </span>
            </h4>
        </div>
        <div class="row">
            <div class="col s12 m12">
            <ul class="collection borderNone">
                <div class="row">
              <section id="modalSection-following">
<!-- PreLoader -->
<div class="row center-align" id="Preloader-following">
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
              </section>
                </div>
              </ul>       
          </div>
        </div>
        
            
        
      </div>
      <!--<div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
      </div>-->
    </div>