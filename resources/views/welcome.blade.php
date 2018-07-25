@extends('layouts.welcomeLayout')

@section('main')
<!-- Vertical spacing -->
<div class="Vspace"></div>
<div class="VeryBigspace show-on-large"></div>
    <!-- End vertical spacing -->

<!-- Main Show case -->
<div class="container">
    <div class="row ">
        <div class="col s12 m6 cyan-text text-accent-4">
            <h1 data-aos="fade-up-left">
                <b>
                    A platform to exchange items    
                </b> 
            </h1>
            <div class="divider"></div>
                <!-- the <p></p> -->
                <p></p> 
                <!-- Is for padding -->
            <a  href = "{{route('showPostsNoAuth')}}" class = "btn  waves-effect waves-light btn-large hoverable exploreButton" data-aos="zoom-in">
                    Explore! <i class="material-icons right">remove_red_eye</i>
            </a>
        </div>
    </div>
</div>
<!-- end main Show case -->
@endsection


@section('section-three')
<div class="container">
        <h1 class="white-text center">
                <b>
                    Who we are
                </b>     
            </h1>
            <div class="divider"></div>

    <div class="row">
        <div class="col s12 m6">
            <img src="{{asset('images/pccc.png')}}" alt="who we are image" class="responsive-img" data-aos="fade-up">               
            <p class="white-text">A group of IT students in philadelphia university</p>
        </div>

        

        <div class="col s12 m6">
            <img src="{{asset('images/philadelphia2.jpg')}}" alt="philadelphia logo" class="responsive-img center" data-aos="flip-left">
            <h3 class="cyan-text text-accent-4 flow-text"  data-aos="fade-up-right">
                A project with the guide of 
                <span class="white-text">
                        Dr. Hassan Moh'd Hasan Alrefai
                </span>
            </h3>

            <div class="divider"></div>

            <h4 class="flow-text white-text" data-aos="fade-up-left">
                Built to the purpose of trying to 
                <span class="cyan-text text-accent-4">
                        replace the money factor
                </span>
                 in some of the tading that happening today, or just for amateurs
            </h4>
            <a href="https://en.wikipedia.org/wiki/Philadelphia_University_(Jordan)" 
            class="btn  waves-effect waves-light btn-large  hoverable exploreButton"
            target="_blank"
            data-aos="fade-down-right">Read more about philadelphia</a>
        </div>
    </div>
</div>
@endsection


@section('footer')
<div class="footer-copyright">
        <div class="container">
          © 2019 Lorem, ipsum.
        <a class="grey-text text-lighten-4 right" href="{{url('/')}}" 
        
        >
            <img src="{{asset('images/logo.png')}}" alt="logo" >
        </a>
        </div>
</div>
@endsection