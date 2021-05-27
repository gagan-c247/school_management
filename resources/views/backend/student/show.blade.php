@extends('backend.backend',['title'=>'Student Profile'])

@section('header')
@endsection         
@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('backend.student.profileSidebar')
        </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Student</h4>
            <p class="card-category"> {{$student->name ?? 'Student'}} profile</p>
          </div>
          <div class="card-body">
              <div class="row">
                <div class="col-md-5">
                    <label class="bmd-label-floating">class</label>
                    <p class="text-white  border-bottom">{{$student->studentclass->name ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-3">
                    <label class="bmd-label-floating">Username</label>
                    <p class="text-white  border-bottom">{{$student->username ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Email</label>
                    <p class="text-white  border-bottom">{{$student->email ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <label class="bmd-label-floating">Stundent Name</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->name ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-6">
                    <label class="bmd-label-floating">Date of Birth</label>
                    <p class="text-white  border-bottom">{{date_format(date_create($student->dob),'d M Y') ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                    <label class="bmd-label-floating">City</label>
                    <p class="text-white  border-bottom">{{$student->city ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Country</label>
                    <p class="text-white  border-bottom">{{$student->country ?? 'Not Defined'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Postalcode</label>
                    <p class="text-white  border-bottom">{{$student->pincode ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                    <label class="bmd-label-floating">Stundent Mobile Number</label>
                    <p class="text-white  border-bottom">{{$student->mobile ?? 'Not Defined'}}</p>
                  </div>
                  <div class="col-md-6">
                    <label class="bmd-label-floating">Status</label>
                    <p class="text-white  border-bottom">{{isset($student->status) && $student->status == '1' ? 'Actice' : 'Unactive'}}</p>
                  </div>    
              </div>
              <div class="row">
                <div class="col-md-6">
                 
                </div>
                <div class="col-md-6">
                    <label class="bmd-label-floating">Gender</label>
                    <p class="text-white  border-bottom">{{$student->gender ?? 'Not Defined'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <label class="bmd-label-floating">About Me</label>
                    <p class="text-white  border-bottom">{{$student->about ?? 'Not Defined' }}</p>
                </div>
              </div>
              <div class="clearfix"></div>
          </div>
        </div>
      </div>
  </div>
{{-- Student details END --}}
@endsection
@section('footer')
@endsection