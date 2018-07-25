@include('layouts.defaults')

    <div class="main">
        <!-- Nav -->
            {{-- @include('layouts.nabBarWelcome') --}}
            @navBarWelcome()
            @endnavBarWelcome
        <!-- End Nav -->

    @yield('main')
    </div>
    <section class="section-three">
        @yield('section-three')
    </section>
    
    
    <footer class="page-footer grey darken-2">
        @yield('footer')
    </footer>
    <!-- J -->
@include('layouts.defaultsBottom')