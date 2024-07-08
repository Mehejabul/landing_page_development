<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard </title>
    {{-- <link rel="apple-touch-icon" href="{{ asset('admin_template/app-assets/images/ico/apple-icon-120.png') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="icon" href="{{ asset('frontend') }}/images/favicon.png" sizes="32x32" />
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    @yield('css')
    <style>
        .main-menu .navbar-header .navbar-brand .brand-logo .logo{height: 60px !important;}
    </style>
</head>
<!-- END: Head-->
