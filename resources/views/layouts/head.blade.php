<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon-->
      <link rel="icon" href="{{ asset('img/logo/logoW.png') }}">
      <!-- Author Meta -->
      <meta name="author" content="Davd Cirakaza">
      <!-- Meta Description -->
      <meta name="description" content="">
      <!-- Meta Keyword -->
      <meta name="keywords" content="">
      <!-- Site Title -->
      <title>PIMIS</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"  crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Calendar plugin CSS -->
    <link href="{{  asset('vendors/fullcalendar/packages/core/index.global.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{  asset('vendors/fullcalendar/packages/daygrid/index.global.min.css') }}" rel="stylesheet" type="text/css"/>
	<!-- Bootstrap Dropzone CSS -->
	<link href="{{  asset('vendors/dropify/dist/css/dropify.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Toggles CSS -->
    <link href="{{  asset('vendors/jquery-toggles/css/toggles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{  asset('vendors/jquery-toggles/css/themes/toggles-light.css') }}" rel="stylesheet" type="text/css">

    <!-- ION CSS -->
    <link href="{{  asset('vendors/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{  asset('vendors/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css') }}" rel="stylesheet" type="text/css">

    <!-- Team Dropdown CSS -->
    <link href="{{  asset('vendors/team_dropdown/dist/css/team_dropdown.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Duration CSS -->
    <link href="{{  asset('vendors/duration/dist/css/duration.css') }}" rel="stylesheet" type="text/css" />

    <!-- select2 CSS -->
    <link href="{{  asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Pickr CSS -->
    <link href="{{  asset('vendors/pickr-widget/dist/pickr.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- Daterangepicker CSS -->
    <link href="{{  asset('vendors/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

    <!-- Lightgallery CSS -->
    <link href="{{ asset('dist/css/lightgallery.css') }}" rel="stylesheet" type="text/css">
    <!-- Morris Charts CSS -->
    <link href="{{ asset('vendors/morris.js/morris.css') }}" rel="stylesheet" type="text/css">


    <!-- Toastr CSS -->
    <link href="{{ asset('vendors/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">






    <link href="{{ asset('css/nav.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css" media="print">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" type="text/css" media="print">





</head>


