<!-- fullScreenModal -->
<div id="followersModal" class="modal grey darken-3 seeFollowersModal">
  <div class="fixed-action-btn">
     <button class="btn-floating amber lighten-2 z-depth-5 waves-effect waves-purple" id="modalLoadMore-followers">
     <i class="large material-icons">call_received</i>
     </button>
  </div>
  <div class="row paddingSocial">
     <div class="col s12 m6 white-text">
        <p class="hide-on-small-only">Press <span class="red-text">Esc</span> To go back or the X Button</p>
     </div>
     <div class="col s12 m6">
        <a class="btn-floating waves-effect waves-light deep-orange accent-4 z-depth-5 userInfoRevealCard modal-close">
        <i class="material-icons">close</i>
        </a>
     </div>
     <div class="input-field col s12 m12">
        <i class="material-icons prefix grey-text text-lighten-3">search</i>
        <input id="searchFilter-followers" type="text">
        <label for="searchFilter-followers">Filter by first name</label>
     </div>
  </div>
  <div class="modal-content">
     <div class="row cyan-text text-lighten-1">
        <h4>
           Your followers
           <span id="followersNumberModal" class="userInfoRevealCardMailTitle">
              <!-- followers number -->
           </span>
        </h4>
     </div>
     <div class="row">
        <div class="col s12 m12">
           <ul class="collection commentCollectionRemoveUl">
              <div class="row">
                 <section id="modalSection-followers">
                    <!-- PreLoader -->
                    <div class="row center-align" id="Preloader-followers">
                       <div class="preloader-wrapper big active ">
                          <div class="spinner-layer spinner-blue-only">
                             <div class="circle-clipper left">
                                <div class="circle"></div>
                             </div>
                             <div class="gap-patch">
                                <div class="circle"></div>
                             </div>
                             <div class="circle-clipper right">
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