@extends('layouts.app')
@section("styles")
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.css"/>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/css/iziToast.min.css"/>
@endsection
@section('content')
    <div id="{{ isset(Auth()->user()->id) ? 'post' : ''}}" >
        {{-- Load post here --}}
        @post(['post' => $post, 'postImages' => $postImages, 'isWished' => $isWished])
        @endpost    
        {{-- Load the comments here --}}
        @comments(['comments' => $comments, 'status' => $post->status])
        @endcomments
    </div>
@endsection
@section("scripts")
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.1/emojionearea.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.3.0/js/iziToast.min.js"></script>
@endsection
