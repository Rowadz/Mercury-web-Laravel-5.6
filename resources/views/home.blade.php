@extends('layouts.app')
{{-- @section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
@endsection --}}
@section('content')
    <div class="ui grid" id="feed">
        <div class="row">
            {{-- Load cards That come with the view --}}
            @offersCards(["posts" => $posts])

            @endoffersCards
            {{-- Load the feed list --}}
            @feedList

            @endfeedList
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
@endsection