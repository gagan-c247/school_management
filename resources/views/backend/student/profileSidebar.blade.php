<div class="card card-profile">
    <div class="card-avatar">
          {{-- <a href="#pablo">
          <img class="img" src="{{asset('assets/img/faces/marc.jpg')}}">
          </a>
          --}}
        <div class="circle upload-button">
            <!-- User Profile Image -->
            @if(isset($student->file) && $student->file->filepath != '')
                <img class="profile-pic" src="{{'/storage/images/'.$student->file->filepath}}">
            @else
                <img class="img profile-pic" src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg">
            @endif 
        </div>  
    </div>
    <div class="card-body">
      <h6 class="card-category">Class {{$student->studentclass->name ?? 'Your Class'}}</h6>
      <h4 class="card-title text-capitalize">{{$student->name ?? 'student name'}}</h4>
      <h4 class="card-title">{{$student->username ?? 'username'}}</h4>
      <p class="card-description">
        
      </p>
      <a href="{{route('admin.student.show',$student->id)}}" class="btn active pull-center d-block {{Request::segment(3) == $student->id ? 'btn-warning' : '' }}"><i class="fa fa-user mr-2"></i>{{$student->name ?? ''}} Profile</a>
      <a href="{{route('admin.family',$student->id)}}" class="btn  active pull-center d-block {{Request::segment(3) == 'family' ? 'btn-warning' : '' }}"><i class='fa fa-users mr-2'></i>{{$student->name ?? ''}} Family</a>
      <a href="{{route('admin.guardian',$student->id)}}" class="btn active pull-center d-block {{Request::segment(3) == 'guardian' ? 'btn-warning' : '' }}"><i class="fa fa-user mr-2"></i>{{$student->name ?? ''}} Guardian</a>
      <div class="clearfix"></div>
    </div>
</div>