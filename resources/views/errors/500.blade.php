@include('layouts.defaults')    
    @navBar(['style' => 'grey darken-3 z-depth-5'])
    @endnavBar

    <div class="row">
        <div class="col s12 m4 l4"></div>
        <div class="col s12 m4 l4">
            <div class="VeryBigspace"></div>
            <div class="VeryBigspace"></div>
           <div class="card transparent z-depth-0">
              <div class="card-image">
                 <img src="{{asset('images/27-min.png')}}" alt="no data found" class="responsive-img" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                 <p class="card-title black-text" data-aos="zoom-in-right">
                     <span class="chip strongChips blue-grey darken-4 white-text">
                         Something went bad, and we are trying to fix it 🤖
                    </span>
                </p>
              </div>
           </div>
        </div>
     </div>
@include('layouts.defaultsBottom')