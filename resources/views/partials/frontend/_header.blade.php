
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}} | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Bootstrap 4 Landing Page Template" />
    <meta name="keywords" content="Saas, Software, multi-uses, HTML, Clean, Modern" />
    <meta name="author" content="Connexxion Group" />
    <meta name="email" content="shreethemes@gmail.com" />
    <meta name="website" content="http://www.cnx247.com" />
    <meta name="Version" content="v2.5.1" />
    <link rel="shortcut icon" href="{{asset('/frontend/images/favicon.ico')}}">
    <link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/frontend/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="{{asset('/frontend/css/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('/frontend/css/owl.theme.default.min.css')}}"/>
    <link href="{{asset('/frontend/css/style.css')}}" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{asset('/frontend/css/colors/default.css')}}" rel="stylesheet" id="color-opt">
    @yield('extra-styles')
    @livewireStyles
</head>
