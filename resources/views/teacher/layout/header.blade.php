<!doctype html>
<html lang="en">

<head>
  <title>{{$title ?? 'School Management'}}</title>
  <!-- Required meta tags -->   
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{asset('assets/css/material-dashboard.css?v=2.1.0')}}" rel="stylesheet" />
  <style>
      .navbar-dark{
          background: #020120 !important;
      }
  </style>
  @yield('header')
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="./assets/img/sidebar-2.jpg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
        -->
      <div class="logo">
        <a href="{{url('/home')}}" class="simple-text logo-normal">
          {{config('app.name')}}
        </a>
      </div>
      @include('teacher.layout.sidemenu')
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark   fixed-top" style="position: sticky; display: flex;">
        <div class="container-fluid">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="javascript:void(0)">{{$title ?? 'Page Title'}}<div class="ripple-container"></div></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
              <span class="">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
              <form class="navbar-form">
                <span class="bmd-form-group"><div class="input-group no-border">
                  <input type="text" value="" class="form-control" placeholder="Search...">
                  <button type="submit" class="btn btn-default btn-round btn-just-icon">
                    <i class="material-icons">search</i>
                    <div class="ripple-container"></div>
                  </button>
                </div></span>
              </form>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="javascript:void(0)">
                    <i class="material-icons">dashboard</i>
                    <p class="d-lg-none d-md-block">
                      Stats
                    </p>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">notifications</i>
                    <span class="notification">5</span>
                    <p class="d-lg-none d-md-block">
                      Some Actions
                    </p>
                  <div class="ripple-container"></div></a>
                  <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="javascript:void(0)">Mike John responded to your email</a>
                    <a class="dropdown-item" href="javascript:void(0)">You have 5 new tasks</a>
                    <a class="dropdown-item" href="javascript:void(0)">You're now friend with Andrew</a>
                    <a class="dropdown-item" href="javascript:void(0)">Another Notification</a>
                    <a class="dropdown-item" href="javascript:void(0)">Another One</a>
                  </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:void(0)" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                        Account
                        </p>
                        <div class="ripple-container"></div>
                        @if(auth()->guard('teacher')->check())
                        {{auth()->guard('teacher')->user()->name ?? 'Test'}}
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbarDropdownMenuLink1">
                        <div class="dropdown-header text-capitalize bg bg-warning font-weight-bold text-center">   
                          @if(auth()->guard('teacher')->check())
                          {{auth()->guard('teacher')->user()->name ?? 'Test'}}
                          @endif
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)">Dashbord</a>
                        <a class="dropdown-item {{\Request::segment(2) == 'teacher' && \Request::segment(3) == 'create' ? 'active' : ''}}" href="{{--route('teacher.index')--}}">Add Teacher</a>
                        <a class="dropdown-item {{\Request::segment(2) == 'teacher' && \Request::segment(3) != 'create' ? 'active' : ''}}" href="{{--route('teacher.index')--}}">All Teacher</a>
                        <a class="dropdown-item {{\Request::segment(2) == 'student' && \Request::segment(3) == 'create' ? 'active' : ''}}" href="{{--route('teacher.index')--}}">Add Student</a>
                        <a class="dropdown-item {{\Request::segment(2) == 'student' && \Request::segment(3) != 'create' ? 'active' : ''}}" href="{{--route('teacher.index')--}}">All Student</a>  
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                    </div>
                </li>
              </ul>
            </div>
          </div>
      </nav>
      <!-- End Navbar -->