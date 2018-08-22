{{-- <script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous" ></script> --}}

    {{-- <script src="https://unpkg.com/aos@next/dist/aos.js"></script> --}}
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}" ></script>
    

@auth
<input type="text" value="{{Auth()->user()->name}}"  id="authUserName" hidden>
{{-- <script src="{{ asset("js/checkForFollower.js") }}"></script> --}}
@endauth
</body>
</html>