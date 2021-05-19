@include('student.layout.header')
<div class="content">
    <div class="container-fluid">
        <!-- your content here -->
        {{-- <h1>Dashbord</h1> --}}
        @yield('content')
    </div>
</div>
@include('student.layout.footer')