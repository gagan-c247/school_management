@include('backend.layout.header')

<div class="content mt-3">
    <div class="container-fluid">
        @foreach (['success','danger','warning','primary'] as $session)
            @if (Session::has($session))
            <div class="row">
                <div class="offset-3 col-md-6">
                    <div class="alert alert-{{$session}}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                        </button>
                        <span>
                        <b> {{$session}} - </b> {{Session::get($session)}}</span>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
        <!-- your content here -->
        @yield('content')
    </div>
</div>
@include('backend.layout.footer')