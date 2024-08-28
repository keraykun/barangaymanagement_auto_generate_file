<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- This is the CSRF token meta tag -->
<title>Barangay Management</title>
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<!-- Vendors styles-->
<link rel="icon" href="{{ asset('images/sagnu.png') }}">
<link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css') }}">
<!-- Main styles for this application-->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css"> --}}
<link rel="stylesheet" href="{{ asset('css/examples.css') }}">
<link rel="stylesheet" href="{{ asset('css/org.css') }}">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="{{ asset('vendors/fontawesome6/css/all.min.css') }}">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.2.0/dist/flowbite.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.2.0/dist/flowbite.min.js"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.0/flowbite.min.js"></script> --}}
@vite('resources/css/app.css')

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.rtl.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>


    @vite('resources/css/app.css')

    <!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script src="{{ asset('js/printThis.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<style>
    .nav-link.active{
        background: rgb(54, 151, 91) !important;
    }
    ul.pagination{
        margin: 10px;
    }
    a.page-link{
        color: green !important;
    }
    .page-item.active .page-link{
        background: rgb(19, 150, 95) !important;
        border: 1px solid rgb(19, 150, 95) !important;

    }
</style>
<style>
    .ajs-cancel {
  display: none;
}
.hide-content{

}
</style>

</head>
<body>
<div class="sidebar bg-green-700 sidebar-fixed hide-content" id="sidebar">





    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        @if (Session::has('barangay'))
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('admin.municipal.show',Session::get('barangay')->municipal->id) }}">
            <svg class="nav-icon">
            </svg>
            <span class="text-lg font-bold">{{ Session::has('barangay')? Session::get('barangay')->name : '' }}</span>
            </a>
            </li>
            <li class="nav-item  text-center">
               <span class="text-lg font-bold"> {{ auth()->user()->name }}</span>
            </li>
        @else
         <script>
             window.location.href = "{{ route('admin.error404') }}";
         </script>
        @endif
    <li class="nav-title mt-0">Features</li>



    @if (in_array('dashboard', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
    <li class="nav-item ">
        <a class="nav-link {{ Route::is('admin.dashboard.*')?'active':'' }}" href="{{ Route('admin.dashboard.index') }}">
            <span class="flex gap-x-3 items-center">
                <i class="fa-solid fa-computer"></i></i><span>Dashboard</span>
            </span>
        </a>
    </li>
    @endif

    @if (in_array('file', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
    <li class="nav-item ">
        <a class="nav-link {{ Route::is('admin.file.*')?'active':'' }}" href="{{ Route('admin.file.index') }}">
            <span class="flex gap-x-3 items-center">
                <i class="fa-solid fa-file"></i></i><span>Files</span>
            </span>
        </a>
    </li>
    @endif

    {{-- <li class="nav-item ">
        <a class="nav-link {{ Route::is('admin.information.*')?'active':'' }}" href="{{ Route('admin.information.index') }}">
            <span class="flex gap-x-3 items-center">
                <i class="fa-solid fa-info-circle"></i></i><span>Barangay Information</span>
            </span>
        </a>
    </li> --}}

    {{-- <li class="nav-item ">
        <a class="nav-link {{ Route::is('admin.organization.*')?'active':'' }}" href="{{ Route('admin.organization.index') }}">
            <span class="flex gap-x-3 items-center">
                <i class="fa-solid fa-bar-chart"></i></i><span>Barangay Organization</span>
            </span>
        </a>
    </li> --}}
    {{-- <li class="nav-group" id="barangayManagement">
        <a class="nav-link nav-group-toggle" href="#">
            <span class="flex gap-x-3 items-center">
                <i class="fa-solid fa-users"></i><span>Barangay Official</span>
            </span>
        </a>
        <ul class="nav-group-items">
            <li class="nav-item {{ Route::is('admin.organization.*')?'active':''  }}">
                <a class="nav-link {{ Route::is('admin.organization.*')?'active':'' }}" href="{{ Route('admin.organization.index') }}">
                <span class="flex gap-x-3 items-center">
                    <i class="fa-solid fa-map-location"></i></i><span>List of Organization</span>
                </span>
                </a>
            </li>
        </ul>
    </li> --}}
    <li class="nav-group" id="barangayManagement">
        <a class="nav-link nav-group-toggle" href="#">
            <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa-users"></i><span>Barangay Management</span>
            </span>
        </a>
        <ul class="nav-group-items">
            {{-- <li class="nav-item {{ Route::is('admin.position.*')?'active':'' }}">
                <a class="nav-link {{ Route::is('admin.position.*')?'active':'' }}" href="{{ Route('admin.position.index') }}">
                <span class="flex gap-x-3 items-center">
                    <i class="fa-solid fa-ranking-star"></i><span>Positions</span>
                </span>
                </a>
            </li> --}}

            @if (in_array('official', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ Route::is('admin.official.*')?'active':'' }}">
                <a class="nav-link {{ Route::is('admin.official.*')?'active':'' }}" href="{{ Route('admin.official.index') }}">
                <span class="flex gap-x-3 items-center">
                    <i class=""></i></i><span>Officials</span>
                </span>
                </a>
            </li>
            @endif

            @if (in_array('blotter', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ Route::is('admin.report.*')?'active':'' }}">
                <a class="nav-link {{ Route::is('admin.report.*')?'active':'' }}" href="{{ Route('admin.report.index') }}">
                <span class="flex gap-x-3 items-center">
                    <i class=""></i></i><span>Blotter</span>
                </span>
                </a>
            </li>
            @endif

            @if (in_array('resident', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ Route::is('admin.residentlist.*')?'active':'' }}">
                <a class="nav-link {{ Route::is('admin.residentlist.*')?'active':'' }}" href="{{ Route('admin.residentlist.index') }}">
                <span class="flex gap-x-3 items-center">
                    <i class=""></i></i><span>Resident List</span>
                </span>
                </a>
            </li>
            @endif

            @if (in_array('purok', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ (Route::is('admin.district.*') || Route::is('admin.resident.*') || Route::is('admin.indigency.*')) ?'active':''  }}">
                <a class="nav-link {{ (Route::is('admin.district.*') || Route::is('admin.resident.*') || Route::is('admin.indigency.*')) ?'active':''  }}" href="{{ Route('admin.district.index') }}">
                <span class="flex gap-x-3 items-center">
                    <i class=""></i></i><span>Purok</span>
                </span>
                </a>
            </li>
            @endif
        </ul>
    </li>
    <li class="nav-group" id="blotterReports" >
        <a class="nav-link nav-group-toggle" href="#">
            <span class="flex gap-x-3 items-center">
                <i class="fa fa-calendar"></i><span>Reports</span>
            </span>
        </a>
        <ul class="nav-group-items">
            @if (in_array('staff', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ (Route::is('admin.staff.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.staff.*'))?'active':'' }}" href="{{ route('admin.staff.index') }}"><span class="nav-icon"></span>Staff Reports</a></li>
            @endif
            @if (in_array('certificate', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ (Route::is('admin.certificate.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.certificate.*'))?'active':'' }}" href="{{ route('admin.certificate.index') }}"><span class="nav-icon"></span>Certificates Reports</a></li>
            @endif
            @if (in_array('monthly', auth()->user()->roles->pluck('name')->toArray()) || auth()->user()->role=='admin' || auth()->user()->role=='secondary')
            <li class="nav-item {{ (Route::is('admin.monthly.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.monthly.*'))?'active':'' }}" href="{{ route('admin.monthly.index') }}"><span class="nav-icon"></span> Monthly Reports</a></li>
            @endif
        </ul>
    </li>



    {{--  <li class="nav-group" id="serviceManagement" >
        <a class="nav-link nav-group-toggle" href="#">
            <span class="flex gap-x-3 items-center">
                <i class="fa-solid fa-people-roof"></i><span>Services Management</span>
            </span>
        </a>
        <ul class="nav-group-items">
            <li class="nav-item {{ (Route::is('admin.project.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.project.*'))?'active':'' }}" href="{{ route('admin.project.index') }}"><span class="nav-icon"></span> Monthly Reports</a></li>
            <li class="nav-item {{ (Route::is('admin.project.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.project.*'))?'active':'' }}" href="{{ route('admin.project.index') }}"><span class="nav-icon"></span> Complain Reports</a></li>
            <li class="nav-item {{ (Route::is('admin.project.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.project.*'))?'active':'' }}" href="{{ route('admin.project.index') }}"><span class="nav-icon"></span> Blotter Reports</a></li>
           <li class="nav-item {{ (Route::is('admin.project.*'))?'active':'' }}"><a class="nav-link {{ (Route::is('admin.project.*'))?'active':'' }}" href="{{ route('admin.project.index') }}"><span class="nav-icon"></span> Projects</a></li>
        </ul>
    </li>--}}
    @if(auth()->user()->role=='secondary' || auth()->user()->role=='admin')
    <li class="nav-item ">
        <a class="nav-link {{ Route::is('admin.admin.*')?'active':'' }}" href="{{ route('admin.admin.index') }}">
        <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa fa-user"></i></i><span>Manage Staff</span>
        </span>
    </a>
    </li>
    @endif
    @if(auth()->user()->role=='admin')
    <li class="nav-item">
       @if (Session::has('barangay'))
       <a class="nav-link" href="{{ Route('admin.municipal.show',Session::get('barangay')->municipal->id) }}">
       @else
        <script>
            window.location.href = "{{ route('admin.error404') }}";
        </script>
       @endif
        <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa-arrow-left"></i></i><span>Back Barangay</span>
        </span>
        </a>
    </li>
    {{-- <li class="nav-item ">
        <a class="nav-link {{ Route::is('admin.admin.*')?'active':'' }}" href="{{ route('admin.admin.index') }}">
        <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa fa-user"></i></i><span>Secondary Admin</span>
        </span>
    </a>
    </li> --}}
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('signout') }}">
        <span class="flex gap-x-3 items-center">
            <i class="fa-solid fa-power-off"></i></i><span>Sign Off</span>
        </span>
        </a>
    </li>
    </ul>

    <button class="sidebar-toggler" type="button" onclick="hideToggler()" data-coreui-toggle="unfoldable"></button>
    <script>
           function hideToggler(event){
            let sideBar = document.querySelector('#sidebar')
            sideBar.classList.toggle("sidebar-toggler");
        }
    </script>
</div>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
        <svg class="icon icon-lg">
        </svg>
        </button><a class="header-brand d-md-none" href="#">
        <ul class="header-nav d-none d-md-flex">
          {{-- <li class="nav-item text-2xl"><a class="nav-link" href="#">{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->municipal->province->name).' , '.Str::ucfirst(Session::get('barangay')->municipal->name).' '.Str::ucfirst(Session::get('barangay')->name) : '' }}</a></li> --}}
          <li class="nav-item text-2xl"><a class="nav-link" href="#">{{ Session::has('barangay')? Str::ucfirst(Session::get('barangay')->name).'  '.Str::ucfirst(Session::get('barangay')->municipal->name).' , '.Str::ucfirst(Session::get('barangay')->municipal->province->name) : '' }}</a></li>
        </ul>
        <ul class="header-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#">
            <svg class="icon icon-lg">
            </svg></a></li>
        <li class="nav-item"><a class="nav-link" href="#">
            <svg class="icon icon-lg">
            </svg></a></li>
        <li class="nav-item"><a class="nav-link" href="#">
            <svg class="icon icon-lg">
            </svg></a></li>
        </ul>

    </div>
    <div class="header-divider"></div>
    {{-- <div class="container-fluid">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
           <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
        </ol>
        </nav>
    </div> --}}
    </header>
    <div class="flex-grow-1 px-3 mb-5">

@if (Session::has('success'))
<script>
alertify.confirm("Successfully has been added.").set({title:""});

</script>
@endif
@if (Session::has('updated'))
<script>
alertify.confirm("Successfully has been Updated.").set({title:""});

</script>
@endif
@if (Session::has('deleted'))
<script>
alertify.confirm("Successfully has been Deleted.").set({title:""});

</script>
@endif
@error('name')
<script>
alertify.confirm("Name field be must required.").set({title:""});

</script>
@enderror

@error('current_password')
<script>
alertify.confirm("The provided current password does not match your actual password.",).set({title:""});

</script>
@enderror
@error('password')
<script>
alertify.confirm("The password field confirmation does not match..",).set({title:""});

</script>
@enderror


         @yield('content')
    </div>
    <!-- CoreUI and necessary plugins-->

     <script src="{{ asset('vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src={{ asset('vendors/simplebar/js/simplebar.min.js') }}></script>
    <!-- Plugins and scripts required by this view-->
    {{-- <script src="vendors/chart.js/js/chart.min.js"></script>
    <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
     <script src="js/main.js"></script> --}}
  </body>
</html>
