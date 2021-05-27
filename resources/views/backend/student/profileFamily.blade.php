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
                <div class="col-md-6">
                    <label class="bmd-label-floating">Father Name</label>
                    <p class="text-white  border-bottom text-capitalize">{{'Mr. '.$student->family->father_name ?? 'Not Defianed'}}</p>
                </div>
                <div class="col-md-6">
                    <label class="bmd-label-floating">Mother name</label>
                    <p class="text-white  border-bottom text-capitalize">{{'Mrs. '.$student->family->mother_name ?? 'Not Defianed'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <label class="bmd-label-floating">Father Contact No.</label>
                    <p class="text-white  border-bottom">{{$student->family->f_mobile ?? 'Not Defianed'}}</p>
                </div>
                <div class="col-md-6">
                    <label class="bmd-label-floating">Mother Contact No.</label>
                    <p class="text-white  border-bottom">{{$student->family->m_mobile ?? 'Not Defianed'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <label class="bmd-label-floating">Father Email Address</label>
                    <p class="text-white  border-bottom">{{$student->family->f_email ?? 'Not Defianed'}}</p>
                </div>
                <div class="col-md-6">
                    <label class="bmd-label-floating">Mother Email Address</label>
                    <p class="text-white  border-bottom">{{$student->family->m_email ?? 'Not Defianed'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                    <label class="bmd-label-floating">Address</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->family->address ?? 'Not Defianed'}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                    <label class="bmd-label-floating">City</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->family->city ?? 'Not Defianed'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Country</label>
                    <p class="text-white  border-bottom text-capitalize">{{$student->family->country ?? 'Not Defianed'}}</p>
                </div>
                <div class="col-md-4">
                    <label class="bmd-label-floating">Postalcode</label>
                    <p class="text-white  border-bottom">{{$student->family->f_mobile ?? 'Not Defianed'}}</p>
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