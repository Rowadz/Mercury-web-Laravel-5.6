<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Mercury') }}</title>
    <!-- styles -->
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- custom css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Main icon -->
    <link rel="shortcut icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon">
    <!-- MoreCss -->
    @yield('moreCSS')
    <script>
            removeSpecificLoader = (id) => document.querySelector(`.imageLoader${id}`).style.visibility = 'hidden'
    </script>
</head>

<body class="grey darken-4">

