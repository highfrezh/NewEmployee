<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-flex justify-content-between ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
    <!-- Navbar Search -->
          <!-- <form class="form-inline"> -->
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          <!-- </form> -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="img/home.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Employee Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div>
          <a href="#" class="nav-link">
            <p class="text-uppercase">
              {{Auth::user()->username}}
            </p>
          </a>
              <a href="#">
               <h6><span><i class="fas fas fa-eye green"></i></span> Profile</h6>
              </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
               <i class="nav-icon fas fa-tachometer-alt blue"></i>
              <p>
                <strong>DASHBOARD</strong> 
              </p>
            </a>
            <hr class="bg-white">
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
             <h6>
              <i class="nav-icon fas fa-user-circle"></i>
              <span>
                  Employee
              </span>
             </h6>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                System Mangement
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <!-- <router-link to="/bar">Go to Bar</router-link> -->
                <router-link to="/Country" class="nav-link">
                  <i class="fas fa-flag-checkered nav-icon teal"></i>
                  <p>Country</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-location-arrow nav-icon teal"></i>
                  <p>State</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-city nav-icon teal"></i>
                  <p>City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-directions nav-icon teal"></i>
                  <p>Department</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                User Mangement
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
               <!-- <router-link to="/bar">Go to Bar</router-link> -->
                 <router-link to="/users" class="nav-link">
                  <i class="fas fa-user-alt nav-icon cyan"></i>
                  <p>User</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/form" class="nav-link">
                  <i class="fas fa-user-alt nav-icon cyan"></i>
                  <p>Role</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-shield nav-icon cyan"></i>
                  <p>Permission</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
             <a class="nav-link" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                 <i class="nav-icon fa fa-power-off red"></i>
                 <p>
                   {{ __('Logout') }}
                 </p>
            </a>

           

           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Main content -->

<div class="content-wrapper" style="min-height: 139px;">

<v-main class="mx-4" style="max-height: 70%">
 <dashboard></dashboard>
 <router-view></router-view>
</v-main>
</div>
  <!--x Main content  x-->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      We Get You Covered In Your Project..
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Highfrezh Inc.</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>