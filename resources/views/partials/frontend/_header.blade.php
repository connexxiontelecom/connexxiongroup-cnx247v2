
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ERP software of choice" />
    <meta name="keywords" content="Saas, ERP software, Saas application" />
    <meta name="author" content="Connexxion Group" />
    <meta name="email" content="info@cnx247.com" />
    <meta name="website" content="http://www.cnx247.com" />
    <meta name="Version" content="v2.5.1" />
    <link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('/frontend/css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/frontend/css/owl.theme.default.min.css')}}"/>
    <link href="{{asset('/frontend/css/style.css')}}" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{asset('/frontend/css/colors/default.css')}}" rel="stylesheet" id="color-opt">
    @yield('extra-styles')
    @livewireStyles
</head>
