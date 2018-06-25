@extends('layouts.app')

@section('styles')
    {{-- <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Sigmar+One|Titan+One" rel="stylesheet"> --}}
   {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css" /> --}}
@endsection

@section('content')
    <div>
        <img src="{{ asset("images/coolBackgroundMain4.png") }}" alt="Welcome image" class="ui image fluid welcomeImage">
    </div>

    <div class="ui grid fluid" style="padding: 20px; background-color: #1B3440;">
        <div class="sixteen  wide column">
            <div class="ui raised segment">
                <a class="ui red ribbon label"  data-aos="fade-right">Overview</a>
                <span class="mainTitle">Mercury</span>
                <p class="secondText ">An Exchange platform founded as a university graduation project, to help the community.</p>
                <a class="ui blue ribbon label" data-aos="fade-right">Community</a>
                <span class="mainTitle"  >What?</span>
                <p class="secondText">We aim to help any community starting from small neighborhoods to large towns.</p>
            </div>
        </div>
    </div>
    <div class="ui grid fluid" style="padding: 20px; background-color: #1B3440;">
        <div class="sixteen  wide column">
            <div class="ui raised segment">
                <a class="ui orange  ribbon label" id="Philadelphia">University</a>
                <span class="mainTitle Philadelphia">Philadelphia</span>
                <p class="secondText">Philadelphia University is a university in Amman, Jordan.
                    Established in 1989 as a national higher
                    educational institution. </p>
                <a class="ui teal  ribbon label"  data-aos="fade-right">The Group</a>
                <span class="mainTitle">Students</span>
                <p class="secondText">We are a group of four students with the guide of Dr. Hasan Moh'd Hasan Alrefai</p>
            </div>
        </div>
    </div>
    <!-- philadelphia Modal -->
    <div class="ui modal">
        <i class="close icon"></i>
        {{-- <img src="{{ asset('images/close.png') }}" alt="close image" class="ui image  close"> --}}
        <div class="header">
            Philadelphia University
        </div>
        <div class="image content">
            <div class="ui medium image">
                <img src="{{ asset('images/philadelphia.jpg') }}">
            </div>
            <div class="description">
                <div class="ui header">Philadelphia</div>
                <p>Philadelphia Private University was established in 1989 as a national higher
                    educational institution. The university is located 20 km to the north of Amman, on the road to Jerash.
                    Philadelphia University has eight faculties and a student body of more than six thousand students. Its academic staff consists of over 300 faculty members,
                    who hold degrees from a wide range of distinguished universities.</p>
                <h3>
                    Name and Significance
                </h3>
                <p>
                    The name "Philadelphia" is derived from the cultural heritage of Jordan. It is the former name of Amman,
                    given to it by Ptolemaeus Philadelphus in the year 285 B.C.
                    This phase of the history of Jordan is captured in the Hellenistic columns in the university's logo.
                    The flag places the logo on a white background.
                </p>
                <p><a href="https://en.wikipedia.org/wiki/Philadelphia_University_(Jordan)" target="_blank">Read more</a></p>
            </div>
        </div>
    </div>
    <!-- END philadelphia Modal -->
    <div style="padding: 20px; ">
        <div class="ui items container">
            <div class="item">
                <div class="ui small image" data-aos="fade-up-right">
                    <img src="{{asset('images/warrior.png')}}" alt="warrior" class="ui small image">
                </div>
                <div class="middle aligned content">
                    <div class="header mainTitle">
                        Ascent people
                    </div>
                    <div class="description">
                        <p class="secondText">
                            People on the old times used to exchange goods and items with each other
                        </p>
                    </div>
                </div>
            </div>
            <div class="item" >
                <div class="ui small image" data-aos="fade-up-right">
                    <img src="{{asset('images/human.png')}}" alt="warrior" class="ui small image">
                </div>
                <div class="middle aligned content">
                    <div class="header mainTitle">
                        Modern people
                    </div>
                    <div class="description">
                        <p class="secondText">
                            people today still do the same thing but in much less rate, but they do it without an organized way.
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div style="background-color: #1B3440">
        <div class="ui grid">
            <div class="sixteen wide column center aligned">
                <h1 class="whiteText mainTitle bigText" >What can you exchange?</h1>
            </div>

            <div class="three wide column">
                <div class="ui" data-aos="fade-up-right">
                <img src="{{asset('images/building-stuff.png')}}" alt="warrior" class="ui meduim image">
                </div>
            </div>
            <div class="eight wide column center aligned">
                <h3 class="whiteText">
                    Starting from a coffee machine, building tools to computer,
                    or even car parts.
                </h3>
            </div>
            <div class="three wide column">

                <img src="{{asset('images/pc.png')}}" alt="warrior" class="ui medium image">
            </div>
            <div class="two wide column">
                <img src="{{asset('images/coffee.png')}}" alt="warrior" class="ui small image">
            </div>
        </div>
    </div>
    <div style="background-color: #1B3440">
        <div class="ui grid">
            <div class="sixteen wide column center aligned">
                <h1 class="whiteText">We handed the wheel to our users, so let lose of your imagination</h1>
                <img src="{{asset('images/imagination.png')}}" alt="warrior" class="ui small image centered ">
            </div>
        </div>
    </div>
    <div class="ui grid" style="padding: 20px !important;">
        <div class="sixteen wide column center aligned">
            <h1 class="bigText">F e a t u r e s</h1>
        </div>
    </div>
    <div class="ui grid container">
        <div class="eight wide column ">
            <img src="{{asset('images/phone.png')}}" alt="warrior" class="ui small image centered ">
        </div>
        <div class="eight wide column ">

                <div class="column">
                    <div class="ui raised segment">
                        <a class="ui green ribbon label">Mobile first approach</a>
                        <p>The design of this web site can work on most browsers and mobiles!,
                        so you can catch up with the latest updates !</p>
                    </div>
                </div>
        </div>
    </div>
    <div class="ui grid container" style="padding: 20px !important;">

        <div class="eight wide column">
            <div class="column">
                <div class="ui raised segment">
                    <a class="ui orange ribbon label right ribbon">Android app!</a>
                    <p>Web sites are not your thing?</p>
                    <p>There is an android app that you can download for free.</p>
                </div>
            </div>
        </div>
        <div class="eight wide column ">
            <img src="{{asset('images/phone2.png')}}" alt="warrior" class="ui small image centered ">
        </div>
    </div>
    <div style="background-color:#1B3440;">
    <div class="ui grid container">
        <div class="eight wide column ">
            <img src="{{asset('images/human4.png')}}" alt="warrior" class="ui medium image centered ">
        </div>
        <div class="eight wide column ">
            <img src="{{asset('images/human3.png')}}" alt="warrior" class="ui medium image centered ">
        </div>
    </div>

    <div class="ui grid container" >

        <div class="sixteen wide column">
            <div class="column">
                <div class="ui raised segment">
                    <a class="ui purple ribbon label">Real time</a>
                    <p>Real time features like chat and notification,
                        so you can be as fast as possible!</p>
                </div>
            </div>
        </div>

    </div>
        <div class="ui grid container" >

            <div class="sixteen wide column">
                <div class="column">
                    <img src="{{asset('images/team.png')}}" alt="warrior" class="ui medium image centered ">
                </div>
            </div>

        </div>
        <div class="ui grid container" >

            <div class="sixteen wide column">
                <div class="column">
                    <div class="ui raised segment">
                        <a class="ui black ribbon label">Multi platform</a>
                        <p>The team worked on a fully functional android
                            application that have the same behavior as the website. And a
                            desktop messenger to make things a lot more fancy for the user.</p>
                        <p>If you found any bug mail it here! fakeEmail@fake.evil</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script> --}}
    {{-- <script src="{{ asset('js/typed.min.js') }}"></script> --}}
@endsection