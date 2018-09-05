@extends('layouts.master')
@section('title', 'Mercury | 👻 👻 👻')

@section('content')
      {{-- @navBar(['style' => 'grey darken-3 z-depth-5'])
    @endnavBar --}}

    <div class="row">
            <div class="col s12 m4 l4"></div>
            <div class="col s12 m4 l4">
                {{-- <div class="VeryBigspace"></div>
                <div class="VeryBigspace"></div> --}}
               <div class="card transparent z-depth-0">
                  <div class="card-image">
                     <img src="{{asset('images/404Error.png')}}" alt="no data found" class="responsive-img"  alt="404">
                     <p class="card-title black-text" data-aos="zoom-in-right">
                         <span class="chip strongChips blue-grey darken-4 white-text">
                             Looks like you are lost 👻 back <a href="/home">home</a>
                            </span>
                        </p>
                  </div>
               </div>
            </div>
         </div>  
@endsection  

@section('scripts')
    @parent
    <script>
            (()=>{
                 let audio = new Audio('../../sounds/404-ghost.mp3')
                 audio.play()
                 M.toast({html: 'You are on the wrong side 👻 👻 👻'})
            })()
      </script>
@endsection
