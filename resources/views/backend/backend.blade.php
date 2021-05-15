@include('backend.layout.header')

<div class="content">
    <div class="container-fluid">
        <!-- your content here -->
        {{-- <h1>Dashbord</h1> --}}
        @yield('content')
    </div>
</div>
@include('backend.layout.footer')