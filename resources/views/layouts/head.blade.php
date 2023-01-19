<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Favicon-->
      <link rel="icon" href="img/logo/logo.png">
      <!-- Author Meta -->
      <meta name="author" content="Davd Tino">
      <!-- Meta Description -->
      <meta name="description" content="">
      <!-- Meta Keyword -->
      <meta name="keywords" content="">
      <!-- Site Title -->
      <title>PIMIS</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />



	<link href="{{  asset('vendors/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>

	<!-- Bootstrap Dropzone CSS -->
	<link href="{{  asset('vendors/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Toggles CSS -->
    <link href="{{  asset('vendors/jquery-toggles/css/toggles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{  asset('vendors/jquery-toggles/css/themes/toggles-light.css') }}" rel="stylesheet" type="text/css">

    <!-- ION CSS -->
    <link href="{{  asset('vendors/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{  asset('vendors/ion-rangeslider/css/ion.rangeSlider.skinHTML5.css') }}" rel="stylesheet" type="text/css">

    <!-- select2 CSS -->
    <link href="{{  asset('vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Pickr CSS -->
    <link href="{{  asset('vendors/pickr-widget/dist/pickr.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{  asset('vendors/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

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

</head>


